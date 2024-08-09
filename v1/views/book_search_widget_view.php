<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Print store Widget
 */
//requre to have div with id=content for js AJAX result display
?>
                    <div id="book_search_widget">
                        <h4>Search Books</h4>
                        <input type="text" placeholder="Search Here" id="s_turm" onchange="search_book(this.value, 'searchbyname', page = 1)" onkeyup="search_book(this.value, 'searchbyname', page = 1)" />
                        <input type="button" value="Search" onclick="search_book(document.getElementById('s_turm').value, 'searchbyname', page = 1)" />
             
                    </div>