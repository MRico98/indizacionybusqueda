<?php
class VectorSpaceModel{

    public function __construct(){
    }

    public function rankingDocuments($query,$documentsinformation){
        $index = $this->indexinInformation($documentsinformation);
        $matchDocs = array();
        $docCount = count($index['docCount']);
        
        foreach($query as $qterm) {
                $entry = $index['dictionary'][$qterm];
                foreach($entry['postings'] as $docID => $posting) {
                        $matchDocs[$docID] +=
                                        $posting['tf'] *
                                        log($docCount + 1 / $entry['df'] + 1, 2);
                }
        }
        
        foreach($matchDocs as $docID => $score) {
                $matchDocs[$docID] = $score/$index['docCount'][$docID];
        }
        
        arsort($matchDocs);
        
        return $matchDocs;
    }


    private function indexinInformation($collection){
        $dictionary = array();
        $docCount = array();

        foreach($collection as $docID => $doc) {
                $terms = explode(' ', $doc);
                $docCount[$docID] = count($terms);

                foreach($terms as $term) {
                        if(!isset($dictionary[$term])) {
                                $dictionary[$term] = array('df' => 0, 'postings' => array());
                        }
                        if(!isset($dictionary[$term]['postings'][$docID])) {
                                $dictionary[$term]['df']++;
                                $dictionary[$term]['postings'][$docID] = array('tf' => 0);
                        }

                        $dictionary[$term]['postings'][$docID]['tf']++;
                }
        }

        return array('docCount' => $docCount, 'dictionary' => $dictionary);
    }

}
?>