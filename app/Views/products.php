<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="css/custom.css" />
    </head>

    <body>

        <nav class="navbar navbar-light bg-light">
            <span class="navbar-text">
                Товары
            </span>
        </nav>

        <main>
            <table class="table">
                <thead class="thead-light font-md">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Наименование</th>
                        <th scope="col">Код</th>
                        <th scope="col">Вес</th>
                        <th scope="col">Кол. в Москве</th>
                        <th scope="col">Кол. в Санкт-Петербурге</th>
                        <th scope="col">Кол. в Самаре</th>
                        <th scope="col">Кол. в Саратове</th>
                        <th scope="col">Кол. в Казани</th>
                        <th scope="col">Кол. в Новосибирске</th>
                        <th scope="col">Кол. в Челябинске</th>
                        <th scope="col">Кол. в Деловые Линии</th>
                        <th scope="col">Цена в Москве, RUB</th>
                        <th scope="col">Цена в Санкт-Петербурге, RUB</th>
                        <th scope="col">Цена в Самаре, RUB</th>
                        <th scope="col">Цена в Саратове, RUB</th>
                        <th scope="col">Цена в Казани, RUB</th>
                        <th scope="col">Цена в Новосибирске, RUB</th>
                        <th scope="col">Цена в Челябинске, RUB</th>
                        <th scope="col">Цена в Деловые Линии, RUB</th>
                        <th scope="col">Взаимозаменяемости</th>
                    </tr>            
                </thead>

                <tbody class="font-sm">

                    <?php

                        foreach($products->paginate(15) as $key => $product)
                        {
                            echo "<tr class='row-item'>";
                            echo "<td class='col-item'>".($key + 1)."</td>";
                            echo "<td class='col-item'>".$product["name"]."</td>";
                            echo "<td class='col-item'>".$product["code"]."</td>";
                            echo "<td class='col-item'>".$product["weight"]."</td>";

                            foreach($cities as $city)
                            {
                                echo "<td class='col-item'>".$product["quantity_".$city['code']]."</td>";
                                echo "<td class='col-item'>".$product["price_".$city['code']]."</td>";
                            }

                            echo "<td class='col-item'>".$product["usage"]."</td>";
                            echo "</tr>";
                        }

                    ?>

                </tbody>
            </table>

        </main>

        <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
                $products->pageLinks();
            ?>        
        </ul>
        </nav>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="js/custom.js" ></script>
        
    </body>
</html>