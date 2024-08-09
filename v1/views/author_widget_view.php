<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Print store Widget
 */
//loading author list
load_model('book');
$books = new book_model();
$authors = $books->get_author_list();
?>
                  <h4>Authors</h4>
                  <ul>
                      <?php
                      foreach ($authors as $key => $author) {
                          echo '<li>
                                    <a onclick="search_book(\''.$author['author'].'\', \'searchbyauthor\', page = 1) " >'.$author['author'].'</a>
                                </li>';
                      }
                      ?> 
                      <script type="text/javascript">
                          
                      </script>
                  </ul>
