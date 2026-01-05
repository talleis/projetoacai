<?php
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Açai_mania</title>
    <link rel="stylesheet" href="style.css">
</head>
<section id="produtos">
    <div class="linha-produtos">

        <!-- Produto Açaí -->
        <div class="produto">
            <img src="imagens/ninhotela.jpg.jpeg" alt="Ninhotela" width="300px" height="300px">
            <h3>Ninhotella</h3>
            <p>Prove nosso copo premium com creme ninho e nutella</p>
            <p>Complementos: açaí, creme de nutella, creme de ninho, frutas</p><br>
            <p> Monte seu açaí a partir de R$ 20,99 </p>
            <button onclick="abrirModal('modal-acai')">Selecione</button>
            <div id="modal-acai" class="modal">
                <div class="modal-conteudo">
                    <span class="fechar" onclick="fecharModal('modal-acai')">&times;</span>
                    <form action="creatPedidos.php" method="post">
                        <label for="celular">celular:</label><br>
                        <input type="hidden" name="nome" value="Ninhotella">
                        <label><input type="text" id="celular" name="celular" required></label><br>
                        <h2>Monte se Açai</h2>
                        <form id="form-acai">
                            <p> Escolha o tamanho:</p>
                            <label><input type="radio" name="tamanho" value="300ml" data-preco="20.99"> 300ml - R$20,99</label><br>
                            <label><input type="radio" name="tamanho" value="500ml" data-preco="28.99"> 500ml - R$28,99</label><br>
                            <label><input type="radio" name="tamanho" value="700ml" data-preco="34.99"> 700ml - R$34,99</label><br><br>
                            <p> Escolha os complementos:</p>
                            <label><input type="checkbox" name="complemento" value="Leite Ninho"> Leite Ninho</label><br>
                            <label><input type="checkbox" name="complemento" value="Paçoca"> Paçoca</label><br>
                            <label><input type="checkbox" name="complemento" value="Granola"> Granola</label><br>
                            <label><input type="checkbox" name="complemento" value="Morango"> Morango</label><br>
                            <label><input type="checkbox" name="complemento" value="Leite Condensado"> Leite Condensado</label><br><br>
                            <p> Adicional </p>
                            <label><input type="radio" name="adicional" value="Nenhum" data-preco="0.00"> Nenhum - R$0,00</label><br>
                            <label><input type="radio" name="adicional" value="Creme de Nutella" data-preco="5.00"> Creme de Nutella - R$5,00</label><br>
                            <label><input type="radio" name="adicional" value="Creme de Ninho" data-preco="5.00"> Creme de Ninho - R$5,00</label><br><br>
                            <P>Endereço de entrega</P>
                            <label for="endereco">Rua:</label><br>
                            <label><input type="text" id="endereco" name="endereco" required></label><br>
                            <label for="bairro">Bairro:</label><br>
                            <label><input type="text" id="bairro" name="bairro" required></label><br>
                            <label for="numero">numero:</label><br>
                            <label><input type="numero" id="numero" name="numero" required></label><br>
                            <label for="obs">obs:</label><br>
                            <label><input type="text" id="obs" name="obs" required></label><br>
                            <br>
                            <button type="submit">Finalizar Compra</button>
                        </form>
                </div>
            </div>
        </div>

        <!-- Produto Brownie -->
        <div class="produto">
            <img src="imagens/brownies.jpg.png" alt="Brownie Tradicional" width="300px" height="300px">
            <h3>Brownie Tradicional</h3>
            <p>Brownie macio com cobertura de chocolate meio amargo</p>
            <p>Complementos: chantilly, morango, calda de chocolate</p><br>
            <p> R$ 49,99 </p>
            <button onclick="abrirModal('modal-brownie')">Selecione</button>
            <div id="modal-brownie" class="modal">
                <div class="modal-conteudo">
                    <span class="fechar" onclick="fecharModal('modal-brownie')">&times;</span>
                    <form action="creatPedidos.php" method="post">
                        <label for="celular">celular:</label><br>
                        <label><input type="text" id="celular" name="celular" required></label><br>
                        <input type="hidden" name="nome" value="Brownie">
                        <input type="hidden" name="preco" value="11.99">
                        <h2>Escolha a cobertura</h2>
                        <form id="form-brownie">
                            <label><input type="radio" name="complemento" value="Chantilly"> Chantilly</label><br>
                            <label><input type="radio" name="complemento" value="Morango"> Morango</label><br>
                            <label><input type="radio" name="complemento" value="Calda de Chocolate"> Calda de Chocolate</label><br><br>
                            <P>Endereço de entrega</P>
                            <label for="endereco">Rua:</label><br>
                            <label><input type="text" id="endereco" name="endereco" required></label><br>
                            <label for="bairro">Bairro:</label><br>
                            <label><input type="text" id="bairro" name="bairro" required></label><br>
                            <label for="numero">numero:</label><br>
                            <label><input type="numero" id="numero" name="numero" required></label><br>
                            <label for="obs">obs:</label><br>
                            <label><input type="text" id="obs" name="obs" required></label><br>
                            <br>
                            <button type="submit">Finalizar Compra</button>
                        </form>
                </div>
            </div>
        </div>

        <!-- Produto Barca -->
        <div class="produto">
            <img src="imagens/barca.jpg.png" alt="Barca açai" width="300px" height="300px">
            <h3>Barca açaí 1,5 litros</h3>
            <p>Esta incrível barca vai com tudo de mais incrível pra você e sua companhia aproveitar ao máximo</p>
            <p>Complementos: todos os complementos disponíveis.</p>
            <p> R$ 49,99 </p>
            <button onclick="abrirModal('modal-barca')">Selecione</button>
            <div id="modal-barca" class="modal">
                <div class="modal-conteudo">
                    <span class="fechar" onclick="fecharModal('modal-barca')">&times;</span>
                    <h2>Escolha os complemetos</h2>
                    <form action="creatPedidos.php" method="post">
                        <input type="hidden" name="nome" value="Barca 1.5 litros">
                        <input type="hidden" name="preco" value="49.99">
                        <label for="celular">celular:</label><br>
                        <label><input type="text" id="celular" name="celular" required></label><br>
                        <label><input type="checkbox" name="complemento" value="Leite Ninho"> Leite Ninho</label><br>
                        <label><input type="checkbox" name="complemento" value="Paçoca"> Paçoca</label><br>
                        <label><input type="checkbox" name="complemento" value="Granola"> Granola</label><br>
                        <label><input type="checkbox" name="complemento" value="Morango"> Morango</label><br>
                        <label><input type="checkbox" name="complemento" value="Leite Condensado"> Leite Condensado</label><br><br>
                        <P>Endereço de entrega</P>
                        <label for="endereco">Rua:</label><br>
                        <label><input type="text" id="endereco" name="endereco" required></label><br>
                        <label for="bairro">Bairro:</label><br>
                        <label><input type="text" id="bairro" name="bairro" required></label><br>
                        <label for="numero">numero:</label><br>
                        <label><input type="numero" id="numero" name="numero" required></label><br>
                        <label for="obs">obs:</label><br>
                        <label><input type="text" id="obs" name="obs" required></label><br>
                        <br>
                        <button type="submit">Finalizar Compra</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Produto Tradicional -->
        <div class="produto">
            <img src="imagens/tradicional.jpg" alt="acaiTradicional" width="300px" height="300px">
            <h3>Açaí Tradicional</h3>
            <p>Se delicie com um saboroso e refrescante açaí: o mais completo do mercado</p><br><br>
            <br><br>
            <p> Monte seu açaí a partir de R$ 10,99 </p>
            <button onclick="abrirModal('modal-acaitradicional')">Selecione</button>
            <div id="modal-acaitradicional" class="modal">
                <div class="modal-conteudo">
                    <span class="fechar" onclick="fecharModal('modal-acaitradicional')">&times;</span>
                    <h2>Monte seu Açai</h2>
                    <form action="creatPedidos.php" method="post">
                        <input type="hidden" name="nome" value="Tradicional">
                        <label for="celular">celular:</label><br>
                        <label><input type="text" id="celular" name="celular" required></label><br>
                        <p> Escolha o tamanho:</p>
                        <label><input type="radio" name="tamanho" value="300ml" data-preco="10.99"> 300ml - R$10,99</label><br>
                        <label><input type="radio" name="tamanho" value="500ml" data-preco="15.99"> 500ml - R$15,99</label><br>
                        <label><input type="radio" name="tamanho" value="700ml" data-preco="20.99"> 700ml - R$20,99</label><br><br>
                        <p> Escolha os complementos:</p>
                        <label><input type="checkbox" name="complemento[]" value="Leite Ninho"> Leite Ninho</label><br>
                        <label><input type="checkbox" name="complemento[]" value="Paçoca"> Paçoca</label><br>
                        <label><input type="checkbox" name="complemento[]" value="Granola"> Granola</label><br>
                        <label><input type="checkbox" name="complemento[]" value="Morango"> Morango</label><br>
                        <label><input type="checkbox" name="complemento[]" value="Leite Condensado"> Leite Condensado</label><br><br>
                        <p> Adicional </p>
                        <label><input type="radio" name="adicional" value="Creme De Nutella" data-preco="5.00"> Creme de Nutella - R$5,00</label><br>
                        <label><input type="radio" name="adicional" value="Creme De Leite Ninho" data-preco="5.00"> Creme de Ninho - R$5,00</label><br><br>
                        <P>Endereço de entrega</P>
                        <label for="endereco">Rua:</label><br>
                        <label><input type="text" id="endereco" name="endereco" required></label><br>
                        <label for="bairro">Bairro:</label><br>
                        <label><input type="text" id="bairro" name="bairro" required></label><br>
                        <label for="numero">numero:</label><br>
                        <label><input type="numero" id="numero" name="numero" required></label><br>
                        <label for="obs">obs:</label><br>
                        <label><input type="text" id="obs" name="obs" required></label><br>
                        <br>
                        <button onclick="abrirModal('modal-confirmacao')">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
</section>
<div id="modal-confirmacao" class="modal">
    <div class="modal-conteudo">
        <span class="fechar" onclick="fecharModal('modal-confirmacao')">&times;</span>
        <h2>Confirme seu pedido!</h2>
        <p><strong>Tamanho:</strong> <span id="conf-tamanho"></span></p>
        <p><strong>Complementos:</strong> <span id="conf-complementos"></span></p>
        <p><strong>Adicionais:</strong><span id="conf-adicionais"></span></p>
        <p><strong>Preço Total:</strong> R$ <span id="conf-preco"></span></p>


        <button id="btn-confirmar" type="submit">Confirmar Pedido</button>
        <button id="btn-voltar" type="submit">Editar</button>

    </div>
</div>
<script src="script.js"></script>
</body>

</html>