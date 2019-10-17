
            //TABLE-------------
                echo "<br><br>";
                echo "<table class='table'>";
                echo "<tr>";
                echo "<td><b>";
                print_r("P ID");
                echo "</td>";
                echo "<td><b>";
                print_r("P NAME");
                echo "</td>";
                echo "<td><b>";
                print_r("SUBCAT");
                echo "</td>";
                echo "<td><b>";
                print_r("PROFILING*1.3" );
                echo "</td>";
                echo "<td><b>";
                print_r("VIEW*1.2");
                echo "</td>";
                echo "<td><b>";
                print_r("FAVORITE*1.4");
                echo "</td>";
                echo "<td><b>";
                print_r("ORDER HISTORY*1.5");
                echo "</td>";
                echo "<td><b>";
                print_r("TOTAL SCORE &nbsp;&nbsp;&nbsp;");
                echo "</td>";
                echo "</tr>";
            //TABLE-------------




                echo "<tr>";
                echo "<td>";
                print_r($product['id']);
                echo "</td>";
                echo "<td>";
                print_r($product['productName']);
                echo "</td>";
                echo "<td>";
                print_r($product->getSubCategory->getCategory['gender'].' | '.$product->getSubCategory['subcatName']);
                echo "</td>";
                echo "<td>";
                print_r($profilingCount.' = '.$profilingScore);
                echo "</td>";
                echo "<td>";
                print_r($viewsCounter.' = '.$viewPoints);
                echo "</td>";
                echo "<td>";
                print_r($favoriteCounter.' = '.$favScore);
                echo "</td>";
                echo "<td>";
                print_r($orderCounter.' = '.$historyScore);
                echo "</td>";
                echo "<td>";
                print_r($points);
                echo "</td>";
                echo "</tr>";



                echo '</table>';
