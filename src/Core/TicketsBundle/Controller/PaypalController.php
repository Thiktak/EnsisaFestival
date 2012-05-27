<?php

namespace Core\TicketsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Core\TicketsBundle\Entity\ShoppedTickets;
use Core\TicketsBundle\Form\ShoppedTicketsType;

/**
 * Paypal controller.
 *
 */
class PaypalController extends Controller
{
    public function call() {
        $paypal_account = 'olivar_1338061440_biz@gmail.com';
        $paypal_username = 'olivar_1338061440_biz_api1.gmail.com';
        $paypal_password = '1338061466';
        $paypal_signature = 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-A1fjUM50.VkyCn5EtZZEnhUAAXAb';

        $o = new API_Paypal($paypal_username, $paypal_password, $paypal_signature);

        return $o;
    }

    /**
     * Lists all ShoppedTickets entities.
     *
     */
    public function processAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->get('security.context')->getToken()->getUser();
        //$entities = $em->getRepository('CoreTicketsBundle:ShoppedTickets')->findBy(array('user' => $user->getID(), 'paid < 1'));
        $entities = $em->createQueryBuilder()
            ->from('CoreTicketsBundle:ShoppedTickets', 'st')
            ->select('st')
            ->andWhere('st.user = :user')
            ->andWhere('st.paid != 1 OR st.paid IS NULL')
            ->setParameter('user', $user->getID())
            ->getQuery()
            ->getResult();

        try {
            $o = $this->call();

            foreach( $entities as $entity )
            {
                $o -> addItem(
                    $entity->getTickets()->getId(),
                    $entity->getTickets()->getTitle(),
                    'Ticket individuel au nom de ' . $entity->getName(),
                    $entity->getTickets()->getPrice());
            }

            EntityDump($entities);

            $o -> SetExpressCheckout(
                'http://localhost/ENSISA/TP/festival/www/web/app_dev.php/user/paid/cancel',
                'http://localhost/ENSISA/TP/festival/www/web/app_dev.php/user/paid/return'
            );

            list($url, $response) = array_values($o -> exec(0));

            // On sauvegarde le token pour le traitement
            foreach( $entities as $entity )
            {
                $entity->setToken($response['TOKEN']);
                $em->persist($entity);
            }
            $em->flush();
            
            return $this->redirect($url);
            //Header('Location: ' . $url);
            //Header('Refresh: 0;URL=' . $url); // BUG !
        }
        catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function returnAction() {

        if( !($get_token = $this->getRequest()->query->get('token')) || !($get_PayerID = $this->getRequest()->query->get('PayerID')) )
            throw new Exception('Missing parameters');

        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $entities = $em->getRepository('CoreTicketsBundle:ShoppedTickets')->findBy(array('user' => $user->getID(), 'token' => $get_token));

        try {
            $o = $this->call();

            foreach( $entities as $entity )
                $o -> addItem($entity->getTickets()->getId(), $entity->getTickets()->getTitle(), 'Ticket individuel au nom de ' . $entity->getName(), $entity->getTickets()->getPrice());

            $o -> DoExpressCheckoutPayment($get_token, $get_PayerID);

            list($url, $response) = array_values($o -> exec());
            
            if( $response['ACK'] == 'Success' ) {
              foreach( $entities as $entity ) {
                  $entity->setPaid(true);
                  //$entity->setDatas($response);
                  $em->persist($entity);
              }
              $em->flush();
            }

        }
        catch(Exception $e) {
            die($e->getMessage());
        }

        return $this->render('CoreTicketsBundle:Paypal:return.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function cancelAction() {
        return $this->redirect($this->generateUrl('billeterie'));
    }
}






Class API_Paypal {
    
    protected $paypal_url = 'https://api-3t.sandbox.paypal.com/nvp';
    protected $paypal_version = 56.0;

    protected $paypal_account = 'olivar_1338061440_biz@gmail.com';
    protected $paypal_username = 'olivar_1338061440_biz_api1.gmail.com';
    protected $paypal_password = '1338061466';
    protected $paypal_signature = 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-A1fjUM50.VkyCn5EtZZEnhUAAXAb';

    protected $datas = array(
        'CANCELURL'    => '',
        'RETURNURL'    => '',
        'CURRENCYCODE' => 'EUR',
        'LOCALECODE'   => 'FR',
        'DESC'         => '',
        'AMT'          => '',
        'HDRIMG'       => '',
    );

    protected $items = array();

    protected $response = array();

    protected $buffer = array();


    public function __construct($paypal_username, $paypal_password, $paypal_signature) {
        $this->paypal_username = $paypal_username;
        $this->paypal_password = $paypal_password;
        $this->paypal_signature = $paypal_signature;
    }

    public function __get($sName) {
        return isset($this->datas[strtoupper($sName)]) ? $this->datas[strtoupper($sName)] : null;
    }

    public function __set($sName, $sValue) {
        $this->datas[strtoupper($sName)] = $sValue;
    }

    protected function makeURL(array $datas = null, $method = null) {
        $datas = (array) $datas;

        $datas['VERSION']   = $this->paypal_version;
        $datas['USER']      = $this->paypal_username;
        $datas['PWD']       = $this->paypal_password;
        $datas['SIGNATURE'] = $this->paypal_signature;

        if( $method )
            $datas['METHOD'] = $method;

        return $this->paypal_url . '?' . http_build_query($datas);
    }

    protected function callURL($url) {
        $ch = curl_init($url);

        // Modifie l'option CURLOPT_SSL_VERIFYPEER afin d'ignorer la vérification du certificat SSL. Si cette option est à 1, une erreur affichera que la vérification du certificat SSL a échoué, et rien ne sera retourné. 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
        // Retourne directement le transfert sous forme de chaîne de la valeur retournée par curl_exec() au lieu de l'afficher directement. 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $resultat_paypal = curl_exec($ch);

        parse_str($resultat_paypal, $this->response);

        //EntityDump($this->response);

        if( $this->response['ACK'] == 'Failure' ) {
            throw new \Exception(sprintf('PayPal ERROR : [%s] %s / %s', $this->response['L_ERRORCODE0'], $this->response['L_SHORTMESSAGE0'], $this->response['L_LONGMESSAGE0']));
        }

        return $this->response;
    }

    public function redirect() {
        // https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=".$liste_param_paypal['TOKEN']        
    }

    public function addItem($number, $name, $desc, $amt, $qty = 1) {

        $datas['NAME']   = $name;
        $datas['NUMBER'] = $number;
        $datas['DESC']   = $desc;
        $datas['AMT']    = $amt;
        $datas['QTY']    = $qty;

        $this->items[] = $datas;
    }


    public function SetExpressCheckout($cancelurl = null, $returnurl = null, $amt = null) {
        $total = 0;

        foreach( $this->items as $i => $item ) {
            $datas['L_NAME' . $i]   = $item['NAME'];
            $datas['L_NUMBER' . $i] = $item['NUMBER'];
            $datas['L_DESC' . $i]   = $item['DESC'];
            $datas['L_AMT' . $i]    = $item['AMT'];
            $datas['L_QTY' . $i]    = $item['QTY'];

            $total += $item['QTY'] * $item['AMT'];
        }

        $datas['CANCELURL']    = $cancelurl ?: $this->cancelurl;
        $datas['RETURNURL']    = $returnurl ?: $this->returnurl;
        $datas['CURRENCYCODE'] = $this->currencycode;
        $datas['LOCALECODE']   = $this->localecode;
        $datas['AMT']          = $amt ?: $this->amt ?: $total;

        //die(EntityDump($datas));

        $this->buffer = array(
            'SetExpressCheckout',
            $datas,
            function($response) {
                return array('cmd' => '_express-checkout', 'token' => $response['TOKEN']);
            }
        );
    }

    public function DoExpressCheckoutPayment($token, $PayerID, $amt = 0) {
        $total = 0;
        foreach( $this->items as $i => $item ) {
            $total += $item['QTY'] * $item['AMT'];
        }

        $datas['TOKEN']         = $token;
        $datas['PayerID']       = $PayerID;
        $datas['PAYMENTACTION'] = 'sale';
        $datas['CURRENCYCODE']  = $this->currencycode;
        $datas['AMT']           = $amt ?: $total;

        $this->buffer = array(
            'DoExpressCheckoutPayment',
            $datas
        );
    }

    public function exec($redirect = false, $isSandBox = true) {
        $new_url = null;
        $response = $this->callUrl($url = $this->makeURL($this->buffer[1], $this->buffer[0]));

        if( isset($this->buffer[2]) ) {
            $func = $this->buffer[2];

            $new_url  = $isSandBox ? 'https://www.sandbox.paypal.com/webscr' : 'https://www.paypal.com/webscr';
            $new_url .= '&' . http_build_query((array) $func($response));

            if( $redirect )
                Header('Location: ' . $new_url);
        }

        return array('url' => $new_url, 'response' => $response);
    }

}