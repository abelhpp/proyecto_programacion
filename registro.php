<!-- esto lo uso de portapapeles mientras modifico las hojas -->
<?php while($fila = $resultado){?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                </tr>
                <?php }?>




                <td><?php echo "<button  value='Editar' name='".$fila["id"]."' onclick=\"window.location.href='editar.php?id=".$fila['id']."'>"; ?> </td>
                    <td><?php echo "<form action='baja.php' method='post'>";
                    echo "<input type='hidden' name='id' value='".$fila["id"]."'>";
                    echo "<input type='submit' value='baja'>";
                    echo "</form>";
                    echo "</td>"; ?></td>