<?php
class Index{
    public function __construct()
    {
        $app = Slim\Slim::getInstance();

        $app->get('/',function () use($app)
        {
            $domains = AppModel::getAllDomains();
            $app->render('app.php',array('domains'=>$domains));
        });
        $app->get('/view',function () use($app)
        {
            $app->response()->header('Content-Type', 'application/json');
            $domain = $app->request()->get('domain');
            if(isset($domain) && $domain!='' )
            {
                $domain = AppModel::getDomainInfo($domain);
                echo json_encode($domain);
            }
            else
            {
                $app->response()->status(400);
                echo 'Domain not found';
            }
        });
        $app->post('/add',function () use($app)
        {
            $app->response()->header('Content-Type', 'application/json');
            $post = $app->request()->post();
            $post = array_map('trim', $post);
            if(isset($post['domain']) && $post['domain'] != '' && !AppModel::checkDomainExists($post['domain']))
            {
                $data = array();
                if(isset($post['domain']))
                    $data['domain'] = $post['domain'];
                if(isset($post['title']))
                    $data['title'] = $post['title'];
                if(isset($post['keywords']))
                    $data['keywords'] = $post['keywords'];
                if(isset($post['description']))
                    $data['description'] = $post['description'];

                AppModel::insert($data);
                echo json_encode($data);
            }
            else
            {
                $app->response()->status(400);
                echo 'Domain already exists';
            }
        });
        $app->get('/domaininfo',function () use($app)
        {
            $app->response()->header('Content-Type', 'application/json');
            $domain = $app->request->get('domain');
            if (strpos($domain,'http') === false){
                $domain = 'http://'.$domain;
            }
            $domain = parse_url($domain);
            if($domain && isset($domain['host']) && isset($domain['scheme']))
            {
                if(!AppModel::checkDomainExists($domain['host']))
                {
                    try
                    {
                        $html = file_get_contents($domain['scheme'].'://'.$domain['host']);
                        $doc = new DOMDocument();
                        @$doc->loadHTML($html);
                        $nodes = $doc->getElementsByTagName('title');
                        $response = array(
                            'domain'=> $domain['host'],
                            'title'=>'',
                            'keywords'=>'',
                            'description'=>''
                        );
                        $response['title'] = trim($nodes->item(0)->nodeValue);
                        $metas = $doc->getElementsByTagName('meta');
                        for ($i = 0; $i < $metas->length; $i++)
                        {
                            $meta = $metas->item($i);
                            if($meta->getAttribute('name') == 'description')
                                $response['description'] = $meta->getAttribute('content');
                            if($meta->getAttribute('name') == 'keywords')
                                $response['keywords'] = $meta->getAttribute('content');
                        }
                        echo json_encode($response);
                        exit();
                    }
                    catch(Exception $e)
                    {
                    }
                }
                else
                {
                    $app->response()->status(400);
                    echo 'Domain already exists';
                    exit();
                }
            }
            $app->response()->status(400);
            echo 'Invalid domain';
        });



    }
}
$Index = new Index();