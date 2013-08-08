<?php
// References SIT203 prac php-xml-livesearch

// create dom object
$xmlDoc=new DOMDocument();
$xmlDoc->load("books.xml");

$x=$xmlDoc->getElementsByTagName('book');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all book titles from the xml file if length of q>0
if (strlen($q)>0)
{
$hint="";
for($i=0; $i<($x->length); $i++)
  {
  $y=$x->item($i)->getElementsByTagName('title');
  if ($y->item(0)->nodeType==1)
    {
    //find a link matching the search text
	// string stristr  ( string $haystack  , mixed $needle  [, bool $before_needle = false  ] )
    //Returns all of haystack from the first occurrence of needle to the end. 
	// before_needle
    //If TRUE, stristr() returns the part of the haystack before the first occurrence of the needle.
	//needle and haystack are examined in a case-insensitive manner. 
	
    if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q))
      {
      if ($hint=="")
        {
        $hint="<br /><a>" .
        $y->item(0)->childNodes->item(0)->nodeValue . "</a><br />";
        }
      else
        {
        $hint=$hint . "<a>" .
        $y->item(0)->childNodes->item(0)->nodeValue . "</a><br />";
        }
      }
    }
  }
}

// Set output to "no suggestion" if no hint were found
// or to the correct values
$nohint="<br /><a><strong>No Suggestions</strong></a>";
if ($hint=="")
  {
  $response=$nohint;
  }
else
  {
  $response=$hint;
  }

//output the response
echo $response;
?> 