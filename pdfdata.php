<?php
require('./fpdf/fpdf.php');

$db = new PDO('mysql:host=localhost;dbname=practice','root','');


   
class PDF extends FPDF
{
    function Header()
    {
        $this->Cell(35);
        $this->AddFont('angsa','','angsa.php');
        $this->SetFont('angsa','',20);
   
        // Logo
        $this->Image('./fpdf/tutorial/logo.png',10,6,30);
     
        $this->Cell(80);
        // Title
        $this->Cell(30,20,iconv( 'UTF-8','TIS-620','ฮาริส'),1,0,'C');
        // Line break
        $this->Ln(20);
    }
function ViewTabel($db){

    
    include_once("connect.php");
    $this->Cell(35);
    $this->AddFont('AngsanaNew','','angsa.php');
    $this->SetFont('AngsanaNew','','16');
    $this->SetFillColor(183,146,220);
    $this->SetTextColor(255, 0, 0);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(0.5);
    
   
     
    $this->Cell(25,10,iconv('UTF-8','TIS-620','รหัส'),1,0,0,'c');
    $this->Cell(25,10,iconv('UTF-8','TIS-620','ชื่อ'),1,0,'c');
    $this->Cell(35,10,iconv('UTF-8','TIS-620','งาน'),1,0,0,'c');
    $this->Cell(25,10,iconv('UTF-8','TIS-620','หัวหน้า'),1,0,'c');
    $this->Cell(25,10,iconv('UTF-8','TIS-620','วันที่'),1,0,0,'c');
    $this->Cell(20,10,iconv('UTF-8','TIS-620','เงินเดือน'),1,0,'c');
    $this->Cell(25,10,iconv('UTF-8','TIS-620','โบนัส'),1,0,0,'c');
    $this->Cell(25,10,iconv('UTF-8','TIS-620','เเผนก'),1,0,'c');
    $this->Ln();

    $stmt = $conn->prepare("select e1.*,e2.ENAME AS MGR, d.DNAME from emp e1 
    inner join dept d 
    on e1.DEPTNO = d.DEPTNO
    LEFT OUTER JOIN emp e2 
    on e2.EMPNO = e1.MGR");
    

        
     $stmt = $db->query('select e1.*,e2.ENAME AS MGR, d.DNAME from emp e1 
     inner join dept d 
     on e1.DEPTNO = d.DEPTNO
     LEFT OUTER JOIN emp e2 
     on e2.EMPNO = e1.MGR');


    while($data =$stmt->fetch(PDO::FETCH_OBJ)){
        $this->Cell(35);
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        
        $this->Cell(25,10,$data->EMPNO,1,0,0,'L');
        $this->Cell(25,10,$data->ENAME,1,0,'L');
        $this->Cell(35,10,$data->JOB,1,0,0,'L');
        $this->Cell(25,10,$data->MGR,1,0,'L');
        $this->Cell(25,10,$data->HIREDATE,1,0,0,'L');
        $this->Cell(20,10,$data->SAL,1,0,'L');
        $this->Cell(25,10,$data->COMM,1,0,0,'L');
        $this->Cell(25,10,$data->DNAME,1,0,'L'); 
        $this->Ln();
 
    }
}
function Footer()
{
    $this->Cell(35);

    $this->SetY(-15);
 
    $this->AddFont('AngsanaNew','','angsa.php');
    $this->SetFont('AngsanaNew','','16');
    $this->SetTextColor(255, 0, 0);
    // Page number
    $this->Cell(0,10,iconv('UTF-8','TIS-620','หน้า').$this->PageNo().'/{nb}',0,0,'C');
}


}

// Instanciation of inherited class
$pdf = new PDF();

$pdf->SetAutoPageBreak('boolean auto' );
$pdf->AddFont('AngsanaNew','','angsa.php');
$pdf->SetFont('AngsanaNew','','16');
$pdf->AddPage('c');
$pdf->ViewTabel($db);
$pdf->Footer();
$pdf->Output();
?>
