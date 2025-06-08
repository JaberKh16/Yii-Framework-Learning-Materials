<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section class="view-info mt-2 p-2 border-2">
        <?php
            # accessing
            foreach($model as $key => $value){
                $messageString = "<strong>".$key."</strong>".$value."";
                $messageString  = "$key: \n$value\n"; 
                echo $messageString . "<br>";
            }
        ?>
    </section>
    <section class="mt-4 p-2 border-2">
        <?php 
            use app\models\Article;
            $article = new Article();

            # setter
            $article->setAttributes([
                $article->id = "ID323453",
                $article->title = "The Mummies",
                $article->content = "The mummies is movie",
                $article->content_type = "horror",
                $article->created_at = time()
            ]);

            var_dump($article->getValue());
            $result = $article->getValue();
            $serial_no = 1;
        ?>
        <table class="mt-5">
            <thead>
                <tr>
                    <th>SL No</th>
                    <th>Index</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $key => $value): ?>
                    <tr>
                        <td><?php echo $serial_no++; ?></td>
                        <td><?php  echo $key; ?></td>
                        <td><?php  echo $value; ?></td>
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    
</body>
</html>