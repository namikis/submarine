<?php

namespace App\auto;

 require_once __DIR__ . '/../../vendor/autoload.php';
// use App\Models\content;

// $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
// $dotenv->load();

// $dotenv = \Dotenv\Dotenv::createImmutable(".herokuconfig");
// $dotenv->load();

// try {
//   $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
//   $dotenv->load();
// } catch (\Dotenv\Exception\InvalidPathException $e) {
//   throw $e;
// }
// try {
//   (new \Dotenv\Dotenv(__DIR__.'/../../',".herokuconfig"))->load();
// } catch (\Dotenv\Exception\InvalidPathException $e) {
//   throw $e;
// }


use PDO;

          function getList($st){
            $st = substr($st, 1, -1);
            $data = array();
            $st = explode(', ', $st);
            foreach($st as $string){
              $text = explode(': ', $string);
              $key = substr($text[0], 1, -1);
              $value = substr($text[1], 1, -1);

              if($key != 'next_url'){
                $data[$key] = $value;
              }
            }
            return $data;
          }

          function genInsertQuery($data, $table){
            $data_key = "";
            $data_value = "";
            $count = 0;
            foreach($data as $key => $value){
              if($count > 0){
                $data_key .= ",";
                $data_value .= ",";
              }
              $data_key .= $key;
              $data_value .= "'" . $value . "'";
              $count++;
            }
            return 'INSERT INTO ' . $table . ' (' . $data_key . ') VALUES (' . $data_value . ')';
          }

          function checkExist($data){
            $host = $_ENV['DB_HOST'];
            $user = $_ENV['DB_USERNAME'];
            $pass = $_ENV['DB_PASSWORD'];
            $DB_name = $_ENV['DB_DATABASE'];
          
            $dsn = 'mysql:dbname=' . $DB_name . ';host=' . $host;
            $dbh = new PDO($dsn, $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $image_url = $data['image_url'];
            $sql = "select count(id) as count from auto_contents where image_url = '" . $image_url . "'";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $rec = $stmt->fetchAll();
            if($rec[0]['count'] == 0){
              return 1;
            }else{
              return 0;
            }
          }

          function insertContent($data, $tag){
            $host = $_ENV['DB_HOST'];
            $user = $_ENV['DB_USERNAME'];
            $pass = $_ENV['DB_PASSWORD'];
            $DB_name = $_ENV['DB_DATABASE'];
          
            $dsn = 'mysql:dbname=' . $DB_name . ';host=' . $host;
            $dbh = new PDO($dsn, $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            if(checkExist($data) == 1 && $data['image_url'] != ''){
              $sql = genInsertQuery($data, "auto_contents");
              $stmt = $dbh->prepare($sql);
              $stmt->execute();
  
              $content_id = $dbh->lastInsertId();
              $data2 = array(
                  "content_id" => $content_id,
                  "tag" => $tag
              );
              $sql = genInsertQuery($data2, "auto_tag");
  
              $stmt = $dbh->prepare($sql);
              $stmt->execute();
            }
          }

          echo "crawling...\n";

          $command = "python app/auto/scrape.py ";
          exec($command, $output, $status);


          for($i=0; $i < 5; $i++){
            $dataList[$i] = getList(mb_convert_encoding($output[$i], 'UTF-8', 'SJIS'));
            //insert
            $data = array(
             "tag_id" => "2",
             "image_url" => $dataList[$i]['image'],
             "content_detail" => $dataList[$i]['detail'],
             "content_link" => $dataList[$i]['link'],
             "from_url" => $dataList[$i]['url']
            );
            $tag = $dataList[$i]['tag'];
            insertContent($data, $tag);
            
          }

          echo "finished.";

        
        ?>
    