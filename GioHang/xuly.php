
<?php
    session_start();
    
    include '../config.php';
    if(isset($_GET['action']))
    {
        if($_GET['action']=="xoasp")
        {
            $MaSP = $_GET['MaSP']; 
            $TK = $_GET['TK'];
            foreach($_SESSION['giohang'] as $rowGH)
            {
                if(!($rowGH['TK']==$TK && $rowGH['MaSP']==$MaSP))
                    $GH[] = array('TK'=>$rowGH['TK'], 'MaSP'=>$rowGH['MaSP'], 'soLuong'=>$rowGH['soLuong']);
            }
            $_SESSION['giohang']=$GH;
            
            header("location:../index.php#GH");
        }
    }
    else
    {
        $TK = $_POST['TK'];
    if($_POST['action']=="addSPGH")
    {
        $MaSP = $_POST['MaSP'];
        $MaGBH = $_POST['MaGBH'];
        $soLuong = $_POST['soLuong'];
        $NewSP = array(array('TK'=>$TK, 'MaSP'=>$MaSP, 'soLuong'=>$soLuong)); 
        if(isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])){
            $isset = 0;
            foreach($_SESSION['giohang'] as $rowGH){
                if($rowGH['TK']==$TK && $rowGH['MaSP']==$MaSP)
                {
                    $GH[] = array('TK'=>$rowGH['TK'], 'MaSP'=>$rowGH['MaSP'], 'soLuong'=>$rowGH['soLuong']+$soLuong);
                    $isset =1;
                }
                else
                $GH[] = array('TK'=>$rowGH['TK'], 'MaSP'=>$rowGH['MaSP'], 'soLuong'=>$rowGH['soLuong']);
            }
            if($isset==1)
            {
                $_SESSION['giohang']=$GH;
            }
            else
            $_SESSION['giohang']=array_merge($GH, $NewSP);
        }
        else
            $_SESSION['giohang'] = $NewSP;
        var_dump($_SESSION['giohang']);
    }
    if($_POST['action']=="showGH")
    {
        $TongTien=0;
        if(isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])){
            foreach($_SESSION['giohang'] as $rowGH)
            {
                // <input type='button' class='changeSL_GH' onclick('changeSLSP(".$rowGH['MaSP'].")') id='changeSL_".$rowGH['MaSP']."' value='Thay Đổi'>
                if($rowGH['TK']==$TK)
                {
                    $dataTTSP = mysqli_query($conn, "SELECT * FROM sanpham where MaSP=".$rowGH['MaSP']);
                    $rowTTSP = mysqli_fetch_array($dataTTSP);
                    echo "<td> <img src='./img/".$rowTTSP['HinhAnh']."' alt=''></td>
                    <td>".$rowTTSP['TenSP']."</td>
                    <td>".$rowTTSP['GiaSP']."</td>
                    <td><input type='number' id='SL_".$rowGH['MaSP']."' value='".$rowGH['soLuong']."' disabled>
                    
                    </td>
                    <td>
                        <a href='./GioHang/xuly.php?action=xoasp&TK=$TK&MaSP=".$rowGH['MaSP']."' class='delSP_GH' id='del_".$rowGH['MaSP']."' >Xoá</a>
                    </td>
                    </tr>";
                    

                }
            }
            echo "<script>$('.delSP_GH').on('click',function(){
                console.log('del');
            })</script>";
        }
    }
    if($_POST['action']=="TinhTongTien")
    {
        $TongTien=0;
        if(isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])){
            foreach($_SESSION['giohang'] as $rowGH)
            {
                if($rowGH['TK']==$TK)
                {
                    $dataTTSP = mysqli_query($conn, "SELECT * FROM sanpham where MaSP=".$rowGH['MaSP']);
                    $rowTTSP = mysqli_fetch_array($dataTTSP);
                    $TongTien = $TongTien+$rowGH['soLuong']*$rowTTSP['GiaSP'];
                }
            }
            echo $TongTien;

        }
    }
    if($_POST['action']=="changeSL")
    {
        $MaSP = $_POST['MaSP'];
        $newSL = $_POST['newSL'];
        if(isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])){
            foreach($_SESSION['giohang'] as $rowGH)
            {
                if($rowGH['TK']==$TK && $rowGH['MaSP']==$MaSP)
                    $rowGH['soLuong']=$newSL;
            }
        }
    }
    }
?>
