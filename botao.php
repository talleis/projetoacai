<div style="display: flex; gap: 10px;">

    <form action="atualizaStatus.php" method="POST">
        <input type="hidden" name="id_pedido" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="status" value="1">
        <button type="submit">Aceitar Pedido</button>
    </form>

    <form action="atualizaStatus.php" method="POST">
        <input type="hidden" name="id_pedido" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="status" value="3">
        <button type="submit">Recusar</button>
    </form>


</div>
