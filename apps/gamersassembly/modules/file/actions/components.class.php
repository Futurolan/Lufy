
<?php

class fileComponents extends sfComponents {

    public function executeVideos(sfWebRequest $request) {
        $this->videos = Doctrine_Query::create()
               ->from('fileCategory f')
               ->Where('f.status = 1')
               ->AndWhere('f.type = 1')
               ->orderBy('f.position ASC')
               ->execute();
    }

}
