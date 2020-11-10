<?php
$query = array('is', 'short', 'string');

$index = getIndex();
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

// length normalise
foreach($matchDocs as $docID => $score) {
        $matchDocs[$docID] = $score/$index['docCount'][$docID];
}

arsort($matchDocs); // high to low

var_dump($matchDocs);

function getIndex() {
        $collection = array(
                1 => 'this string is a short string but a good string',
                2 => 'this one isn\'t quite like the rest but is here',
                3 => 'this is a different short string that\' not as short'
        );

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
?>