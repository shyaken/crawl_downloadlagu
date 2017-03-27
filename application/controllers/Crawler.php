<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crawler extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
                $this->load->model('Crawlmodel');
                $this->load->model('Trackmodel');
                for($i = 1; $i <= 6275; $i ++) {
                    $songs = $this->Crawlmodel->getPage($i);
                    $data = [];
                    for($j = 0; $j < 10; $j++ ) {
                        if(!isset($songs[1][$j])) return;
                        $songData = [];
                        $songData['name'] = $songs[1][$j];
                        $analyze = explode('-', $songs[2][$j]);
                        $songData['soundcloud_id'] = $analyze[count($analyze) - 1]; 
                        $soundCloudDataJson = file_get_contents('http://api.soundcloud.com/tracks/'.$songData['soundcloud_id'].'?client_id=1icoStToePrQoYeWLPCatk523oBFOAAr');
                        $soundCloudData = json_decode($soundCloudDataJson);
                        if(!empty($soundCloudData) && !empty($soundCloudData->id)) {
                            if(!empty($soundCloudData->title)) {
                                $songData['name'] = $soundCloudData->title;
                            }
                            $songData['soundcloud_listen'] = $soundCloudData->playback_count;
                            $songData['soundcloud_download'] = $soundCloudData->download_count;
                            $songData['size'] = $soundCloudData->original_content_size;
                            $songData['format'] = $soundCloudData->original_format;
                            $songData['bpm'] = $soundCloudData->bpm;
                            $songData['genre'] = $soundCloudData->genre;
                            $songData['description'] = $soundCloudData->description;
                        } else {
                            echo $soundCloudDataJson . "\n";
                            continue;
                        }
                        $data[] = $songData;
                        $this->Trackmodel->save($songData);
                    }
//                    $this->Trackmodel->saveMulti($data);
                }
                
	}
        
        public function updateInformation() {
            $this->load->model('Trackmodel');
            $tracks = $this->Trackmodel->getAll();
            foreach($tracks as $song) {
                
            }
            print_r($tracks);
            die;
        }
}
