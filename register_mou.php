<?php 
include('include/include.php');
include('header.php');
?>
<style>
    [type="checkbox"]:not(:checked),
[type="checkbox"]:checked {
  position: absolute;
  left: -9999px;
}
[type="checkbox"]:not(:checked) + label,
[type="checkbox"]:checked + label {
  position: relative;
  padding-left: 1.95em;
  cursor: pointer;
}

/* checkbox aspect */
[type="checkbox"]:not(:checked) + label:before,
[type="checkbox"]:checked + label:before {
  content: '';
  position: absolute;
  left: 0; top: 0;
  width: 1.25em; height: 1.25em;
  border: 2px solid #ccc;
  background: #fff;
  border-radius: 4px;
  box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
}
/* checked mark aspect */
[type="checkbox"]:not(:checked) + label:after,
[type="checkbox"]:checked + label:after {
  content: '\2713\0020';
  position: absolute;
  top: .15em; left: .22em;
  font-size: 1.3em;
  line-height: 0.8;
  color: #09ad7e;
  transition: all .2s;
  font-family: 'Lucida Sans Unicode', 'Arial Unicode MS', Arial;
}
/* checked mark aspect changes */
[type="checkbox"]:not(:checked) + label:after {
  opacity: 0;
  transform: scale(0);
}
[type="checkbox"]:checked + label:after {
  opacity: 1;
  transform: scale(1);
}
/* disabled checkbox */
[type="checkbox"]:disabled:not(:checked) + label:before,
[type="checkbox"]:disabled:checked + label:before {
  box-shadow: none;
  border-color: #bbb;
  background-color: #ddd;
}
[type="checkbox"]:disabled:checked + label:after {
  color: #999;
}
[type="checkbox"]:disabled + label {
  color: #aaa;
}
/* accessibility */
[type="checkbox"]:checked:focus + label:before,
[type="checkbox"]:not(:checked):focus + label:before {
  border: 2px dotted blue;
}

/* hover style just for information */
label:hover:before {
  border: 2px solid #4778d9!important;
}

    .text-contextt{
        font-family: "Open sans", "Segoe UI", "Segoe WP", Helvetica, Arial, sans-serif;
        color: #777;
    }






}
</style>
<div class="container">
    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">MOU APPLICATION FORM
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
    <div class="row">
        <div class="panel panel-info">
            <header class="panel-heading">
                <h4>Mou Information</h3>
            </header>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="add_mou.php" enctype="multipart/form-data"> 
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Company Name:</label>
                        <input type="text" class="form-control" name="c_name" />
                    </div>
                    <div class="form-group">
                        <label>Company Address:</label>
                        <input type="text" class="form-control" name="c_address" />
                    </div>
                    <div class="form-group">
                        <label>Company Tel:</label>
                        <input type="text" class="form-control" name="c_tel" />
                    </div>
                    
                    
                    <div class="form-group">
                        <label>User register Course:</label>
                        <select class="form-control" name="course">
                            <option value="">~Select~</option>
                            <option value="5">PROGRAMMING</option>
                            <option value="3">MULTIMEDIA</option>
                            <option value="4">NETWORKING</option>
                            <option value="2">ELECTRONIC</option>
                            <option value="1">ACCOUNTING</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Register year</label>
                        <div class="input-group date form_year" data-date="" data-date-format="yyyy" data-link-field="dtp_input1" data-link-format="yyyy">
                        <input class="form-control" size="16" type="text" value="" >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <input type="hidden" name="register_in" id="dtp_input1" value="" />
                        
                    </div>
                    <div class="form-group">
                        <label>Year End </label>
                        <div class="input-group date form_year" data-date="" data-date-format="yyyy" data-link-field="dtp_input2" data-link-format="yyyy">
                        <input class="form-control" size="16" type="text" value="" >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <input type="hidden" name="register_out" id="dtp_input2" value="" />
                    </div>
                   
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                     <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name" />
                    </div>
                    <div class="form-group">
                        <label>Position:</label>
                        <input type="text" class="form-control" name="position" />
                    </div>
                    <div class="form-group">
                        <label>Tel NO:</label>
                        <input type="text" class="form-control" name="tel" />
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" name="email" />
                    </div> 
                    <div class="form-group">
                        <label>Company website:</label>
                        <input type="text" class="form-control" name="c_link" />
                    </div>

                </div>
                <div class="col-md-12">
                    <fieldset>
                        <legend>COURSE</legend>
                            <div class="col-md-2" class="text-context">
                                <input type="checkbox" id="test1" name="all" /><label for="test1" >ALL</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="test2" name="pro" /><label for="test2">PROGRAMMING</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="test3" name="mul" /><label for="test3">MULTIMEDIA</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="test4" name="net" /><label for="test4">NETWORKING</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="test5" name="elc" /><label for="test5">ELECTRONIC</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="test6" name="acc" /><label for="test6">ACCOUNTING</label>
                            </div>
                    </fieldset>
                </div>
                    
                    <div class="col-md-12">
                        <br>
                        <br>
                        <center>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary" />
                        </center>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

<?php include("footer.php"); ?>