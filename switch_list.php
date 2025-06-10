<?php 
                if(isset($_GET["id"]) && $_GET["id"]!==""){
                    $id="?id=".$_GET["id"];
                }

                ?>
                <div id="menu-outer">
                    <ul id="horizontal-list">
                        <li><a class="btn btn-primary" href="student_edit.php<?=$id?>">Student Information</a></li>
                        <li>/</li>
                        <li><a class="btn btn-danger" href="family.php<?=$id?>">Family Information</a></li>
                        <li>/</li>
                        <li><a class="btn btn-success" href="qualification.php<?=$id?>">Student Qualification</a></li>
                        <li>/</li>
                        <li><a class="btn btn-warning" href="transcript.php<?=$id?>">Transcript</a></li>
                        <li>/</li>
                        <li><a class="btn btn-info" href="student_ptpk.php<?=$id?>">Student PTPK</a></li>
                        <li>/</li>
                        <li><a class="btn btn-success" href="student_offer.php<?=$id?>">Student offer letter</a></li>
                    </ul>
                </div>
                

<style>
    ul#horizontal-list{
	min-width: 800px;
	
	padding-top: 20px;
	}

    
    ul#horizontal-list li {
		display: inline;
        margin-left:20px;
	}

</style>