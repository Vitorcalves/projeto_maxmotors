        <footer>
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <hr>
                    <p>© Copyright 2024 - Max Motors</p>
                </div>
            </div>

        </footer>

        </body>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const cabecario = document.querySelector("cabecario-pagina");
                console.log(<?php echo json_encode(isset($dados['menu']) ? $dados['menu'] : []); ?>);
                cabecario.menus = <?php
                                    echo json_encode(isset($dados['menu']) ? $dados['menu'] : []);
                                    ?>;
            });
            console.log(<?php echo json_encode($dados); ?>);
        </script>

        </html>