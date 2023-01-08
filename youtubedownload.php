<?php
/** 
 * CodexWorld 
 * 
 * This Downloader class helps to download youtube video. 
 * 
 * @class       YouTubeDownloader 
 * @author      CodexWorld 
 * @link        http://www.codexworld.com 
 * @license     http://www.codexworld.com/license 
 */ 
class YouTubeDownloader { 
    /* 
     * Video Id for the given url 
     */ 
    private $video_id; 
      
    /* 
     * Video title for the given video 
     */ 
    private $video_title; 
      
    /* 
     * Full URL of the video 
     */ 
    private $video_url; 
     
    /* 
     * store the url pattern and corresponding downloader object 
     * @var array 
     */ 
    private $link_pattern; 
     
    public function __construct(){ 
        $this->link_pattern = "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed)\/))([^\?&\"'>]+)/"; 
    } 
     
    /* 
     * Set the url 
     * @param string 
     */ 
    public function setUrl($url){ 
        $this->video_url = $url; 
    } 
     
    /* 
     * Get the video information 
     * return string 
     */ 
    private function getVideoInfo(){ 
        return file_get_contents("https://www.youtube.com/get_video_info?video_id=".$this->extractVideoId($this->video_url)."&cpn=CouQulsSRICzWn5E&eurl&el=adunit"); 
    } 
      
    /* 
     * Get video Id 
     * @param string 
     * return string 
     */ 
    private function extractVideoId($video_url){ 
        //parse the url 
        $parsed_url = parse_url($video_url); 
        if($parsed_url["path"] == "youtube.com/watch"){ 
            $this->video_url = "https://www.".$video_url; 
        }elseif($parsed_url["path"] == "www.youtube.com/watch"){ 
            $this->video_url = "https://".$video_url; 
        } 
         
        if(isset($parsed_url["query"])){ 
            $query_string = $parsed_url["query"]; 
            //parse the string separated by '&' to array 
            parse_str($query_string, $query_arr); 
            if(isset($query_arr["v"])){ 
                return $query_arr["v"]; 
            } 
        }    
    } 
     
    /* 
     * Get the downloader object if pattern matches else return false 
     * @param string 
     * return object or bool 
     *  
     */ 
    public function getDownloader($url){ 
        /* 
         * check the pattern match with the given video url 
         */ 
        if(preg_match($this->link_pattern, $url)){ 
            return $this; 
        } 
        return false; 
    } 
      
    /* 
     * Get the video download link 
     * return array 
     */ 
    public function getVideoDownloadLink(){ 
        //parse the string separated by '&' to array 
        parse_str($this->getVideoInfo(), $data); 
        $videoData = json_decode($data['player_response'], true); 
        $videoDetails = $videoData['videoDetails']; 
        $streamingData = $videoData['streamingData']; 
        $streamingDataFormats = $streamingData['formats']; 
          
        //set video title 
        $this->video_title = $videoDetails["title"]; 
          
        //Get the youtube root link that contains video information 
        $final_stream_map_arr = array(); 
          
        //Create array containing the detail of video  
        foreach($streamingDataFormats as $stream){ 
            $stream_data = $stream; 
            $stream_data["title"] = $this->video_title; 
            $stream_data["mime"] = $stream_data["mimeType"]; 
            $mime_type = explode(";", $stream_data["mime"]); 
            $stream_data["mime"] = $mime_type[0]; 
            $start = stripos($mime_type[0], "/"); 
            $format = ltrim(substr($mime_type[0], $start), "/"); 
            $stream_data["format"] = $format; 
            unset($stream_data["mimeType"]); 
            $final_stream_map_arr [] = $stream_data;          
        } 
        return $final_stream_map_arr; 
    } 
      
    /* 
     * Validate the given video url 
     * return bool 
     */ 
    public function hasVideo(){ 
        $valid = true; 
        parse_str($this->getVideoInfo(), $data); 
        if($data["status"] == "fail"){ 
            $valid = false; 
        }  
        return $valid; 
    } 
      
}


if(isset($_POST['url']) && $_POST['url']!=''){
    
    // Load and initialize downloader class 
    include_once 'youtube.php'; 
    $handler = new YouTubeDownloader(); 
     
    // Youtube video url 
    $youtubeURL = 'https://www.youtube.com/watch?v=f7wcKoEbUSA'; 
    $youtubeURL = $_POST['url'];
     
    // Check whether the url is valid 
    if(!empty($youtubeURL) && !filter_var($youtubeURL, FILTER_VALIDATE_URL) === false){ 
        // Get the downloader object 
        $downloader = $handler->getDownloader($youtubeURL); 
         
        // Set the url 
        $downloader->setUrl($youtubeURL); 
         
        // Validate the youtube video url 
        if($downloader->hasVideo()){ 
            // Get the video download link info 
            $videoDownloadLink = $downloader->getVideoDownloadLink(); 
            $videoTitle = $videoDownloadLink[0]['title']; 
            $videoQuality = $videoDownloadLink[0]['qualityLabel']; 
            $videoFormat = $videoDownloadLink[0]['format']; 
            $videoFileName = strtolower(str_replace(' ', '_', $videoTitle)).'.'.$videoFormat; 
            $downloadURL = $videoDownloadLink[0]['url']; 
            $fileName = preg_replace('/[^A-Za-z0-9.\_\-]/', '', basename($videoFileName)); 
             
            if(!empty($downloadURL)){ 
                // Define header for force download 
                header("Cache-Control: public"); 
                header("Content-Description: File Transfer"); 
                header("Content-Disposition: attachment; filename=$fileName"); 
                header("Content-Type: application/zip"); 
                header("Content-Transfer-Encoding: binary"); 
                 
                // Read the file 
                readfile($downloadURL); 
            } 
        }else{ 
            echo "The video is not found, please check YouTube URL."; 
        } 
    }else{ 
        echo "Please provide valid YouTube URL."; 
    } 
}
else{ ?>
    <form action="" method="post">
        <label></label>
        <input type="text" style="width:400px;" name="url" placeholder="Youtube Video URL" required>
        <input type="submit" value="Download Video">
    </form>
    <form action="https://en.savefrom.net/savefrom.php" method="POST" class="sf-form link-form" onsubmit="return sf.checkForm(event);" target="sf_frame">
            <div class="l-box">
              <div class="tarea-wrap">
                <input type="text" name="sf_url" value="" autofocus placeholder="Paste your video link here" onfocus="if(this.value && this.select){this.select()}">
                <a href="#" class="clear-btn"></a>
              </div>
            </div>
            <div class="r-box">
              <button type="submit" name="sf_submit" class="submit">fffffffffffff</button>
            </div>
            <div class="services clearfix"></div>
            <input type="hidden" name="new" value="2">
            <input type="hidden" name="lang" value="en">
                        <input type="hidden" name="app" value="">
            <div class="terms__string">By using our service you accept our <a href="https://en.savefrom.net/34/terms.html" rel="nofollow">Terms of Service</a> and <a href="https://en.savefrom.net/127/privacy-policy.html" rel="nofollow" target="_blank">Privacy Policy</a></div>
          </form>
<?php } ?>

