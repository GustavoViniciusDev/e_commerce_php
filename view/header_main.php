<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Gustavinho AkBoom</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <form class="form-inline">
                            <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="cart-button">
                            <i class="fas fa-shopping-cart"></i> Carrinho
                        </a>
                    </li>
                    <?php if (isset($_SESSION['nome'])): ?>
                        <!-- Se o usuário estiver logado, mostre seu nome e um botão de logout -->
                        <li class="nav-item">
                            <span class="nav-link">Bem-vindo, <?php echo $_SESSION['nome']; ?>!</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Sair
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Se o usuário não estiver logado, mostre os botões de login e registro -->
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fas fa-user"></i> Logar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cadastro.php">
                                <i class="fas fa-user"></i> Cadastrar
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>


    <div id="cart-popover-content" style="display: none;">
        <div class="mini-product-card">
            <div class="card position-relative">
                <span class="favorite-icon">
                    <button type="button" class="btn btn-outline-danger favorite-button"><i class="fas fa-heart"></i></button>
                </span>
                <img src="caminho_para_a_imagem.jpg" alt="Nome do Produto" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Nome do Produto</h5>
                    <p class="card-text">Descrição do produto</p>
                    <p class="card-price">R$ 19.99</p>
                    <button type="button" class="btn btn-primary">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>
        <div class="cart-total">
            <hr>
            <p class="text-center">Preço Total: R$ <span id="cart-total-price">0.00</span></p>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Ative o popover no botão de carrinho
            $('#cart-button').popover({
                container: 'body',
                content: $('#cart-popover-content').html(),
                html: true,
                placement: 'bottom',
            });

            // Mostre o popover quando o botão de carrinho for clicado
            $('#cart-button').on('click', function() {
                $(this).popover('toggle');
            });

            // Feche o popover quando clicar fora dele
            $(document).on('click', function(event) {
                if (!$(event.target).closest('#cart-button').length && !$(event.target).closest('.popover').length) {
                    $('#cart-button').popover('hide');
                }
            });
        });
    </script>