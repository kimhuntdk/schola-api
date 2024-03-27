<?php
if(isset($_GET['fullName'])){
    $fullName = urlencode($_GET['fullName']);
    $url = "https://serpapi.com/search.json?engine=google_scholar&q={$fullName}&hl=en&num=200&api_key=412f5a9f039380d5056ab503ddc4d427e904d547c7a0095e279fd69dc29db913";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if(isset($data['organic_results'])){
        $results = $data['organic_results'];
        if(!empty($results)){
            echo '<h3>Search Results:</h3>';
            echo '<ul>';
            $i=1; ?>
           <form action="chk_schola.php" method="post">
           <input type="submit" name="Submit" value="Add Data" />
    <?php foreach($results as $result) { ?>
       <label>เลือกได้เพียง 1 ตัวเลือกเท่านั้น</label>
     <input type="checkbox" name="chk[]" value="<?php echo $result['link']; ?>"  />
    <!-- คุณสามารถเพิ่ม element input hidden เพื่อเก็บค่า title และ link ได้ -->
    <input type="hidden" name="title[<?php echo $result['link']; ?>]" value="<?php echo $result['title']; ?>" />
    <input type="hidden" name="link[<?php echo $result['link']; ?>]" value="<?php echo $result['link']; ?>" />
    
        <h4><a href="<?php echo $result['link']; ?>" target="_blank"><?php echo $result['title']; ?></a></h4>
        <?php if(isset($result['snippet'])){ ?>
            <p><strong>Snippet:</strong> <?php echo $result['snippet']; ?></p>
            <input type="hidden" name="snippet[<?php echo $result['link']; ?>]" value="<?php echo $result['snippet']; ?>" />
        <?php } ?>
        <?php if(isset($result['publication_info']['summary'])){ ?>
            <p><strong>Publication Info:</strong> <?php echo $result['publication_info']['summary']; ?></p>
            <input type="hidden" name="publication_info[<?php echo $result['link']; ?>]" value="<?php echo $result['publication_info']['summary']; ?>" />
        <?php } ?>
        <?php if(isset($result['resources'])){ ?>
            <p><strong>Resources:</strong></p>
            <ul>
                <?php foreach($result['resources'] as $resource){ ?>
                    <li><a href="<?php echo $resource['link']; ?>" target="_blank"><?php echo $resource['title']; ?></a></li>
                <?php } ?>
            </ul>
        <?php } ?>
    <?php } ?>
    
</form>
              
          <?php  } ?>
          
            <?php
            echo '</ul>';
        } else {
            echo 'No results found.';
        }
    } else {
        echo 'Error occurred while fetching results.';
    }

?>
