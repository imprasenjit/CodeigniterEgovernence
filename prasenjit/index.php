<!--
Author : Prasenjit Das
Website : netrotechnologies.com
Create Date : 02/07/2018

You may edit this code, but please do not remove original information. Thanks :D
-->
<?php
$table_error = '';
$model_res = '';
$controller_res = '';
$list_res = '';
$read_res = '';
$form_res = '';
$page_res = '';
$excel_res = '';
$word_res = '';

if (isset($_POST['table'])) {
    // include connection 
    require 'lib/config.php';

    $connection = mysqli_connect($hostname, $username, $password);
    $select_database = mysqli_select_db($connection,$database);

    if (!$select_database) {
        die('Pleace check database setting on lib/config.php');
    }

    // get table name
    $table = strtolower(trim($_POST['table']));
    $controller = strtolower(trim($_POST['controller']));
    $model = strtolower(trim($_POST['model']));
    $versici = $_POST['versici'];
    $jenistabel = $_POST['jenistabel'];
    $paginationConfig = isset($_POST['paginationConfig']) ? $_POST['paginationConfig'] : '';
    $excel = isset($_POST['excel']) ? $_POST['excel'] : '';
    $word = isset($_POST['word']) ? $_POST['word'] : '';

    //$target = isset($_POST['pathOutput']) ? $_POST['pathOutput'] ."/": "../application/";
    $target = "output/";
    $viewname=$controller;

    $models = isset($_POST['models']) ? $_POST['models'] : '';
    $controllers = isset($_POST['controllers']) ? $_POST['controllers'] : '';
    $views = isset($_POST['views']) ? $_POST['views'] : '';


    $headers = isset($_POST['headers']) ? $_POST['headers'] : false;
    $footers = isset($_POST['footers']) ? $_POST['footers'] : false;

    // cek table in database
    if (mysqli_num_rows(mysqli_query($connection,"SHOW TABLES LIKE '" . $table . "'")) <> 1) {
        // show error
        $table_error = "<p>Table \"" . $table . "\" does not exist</p>";
    } else {
        // setting 
        $model = $model <> '' ? $model : $table . "_model";
        $controller = $controller <> '' ? $controller : $table;
        $html = $controller . "_html";
        $list = $controller . "_list";
        $read = $controller . "_read";
        $form = $controller . "_form";

        //filename
        if ($versici == 2) {
            $model_file = $model . ".php";
            $controller_file = $controller . ".php";
        } else {
            $model_file = ucfirst($model) . ".php";
            $controller_file = ucfirst($controller) . ".php";
        }
        $html_file = $html . ".php";
        $list_file = $list . ".php";
        $read_file = $read . ".php";
        $form_file = $form . ".php";

        if($models)
            require 'lib/createModel.php';

        if($controllers)
            require 'lib/createController.php';

        if($views) { 
		
            require 'lib/createViewForm.php';
            require 'lib/createViewRead.php';

            if ($jenistabel == 'regtable') {
                require 'lib/createViewList.php';
            } else {
                require 'lib/createViewListDatatables.php';
            }

        }
        
        if ($paginationConfig == 'create') {
            require 'lib/createConfigPagination.php';
        }

        if ($excel == 'create') {
            require 'lib/createExportExcelHelper.php';
        }
        
        if ($word == 'create') {
            require 'lib/createViewListHtml.php';
        }
    }
}
?>
<!doctype html>
<html>
    <head>
        <title>Codeigniter CRUD Generator</title>
        <link rel="stylesheet" href="lib/bootstrap.min.css"/>
        <style>
            body{
                padding: 15px;
            }
            p{
                margin-bottom: 5px;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="row" style="margin-top: 10px">
            <h3 align="center">Prasenjit Das CURD generator</h3>
            <div class="col-md-6 col-md-offset-3">
                <form action="index.php" method="post">
                    <div class="form-group">
                        <input onkeyup="setname()" id="table" type="text" name="table" value="<?php echo isset($_POST['table']) ? $_POST['table'] : '' ?>" class="form-control" placeholder="Input Table Name" />
                    </div>
                    <?php $def_versi = isset($_POST['versici']) ? $_POST['versici'] : '2'; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                <label>
                                    <input type="radio" name="versici" id="2" value="2" <?php echo $def_versi == '2' ? 'checked' : ''; ?>>
                                    Codeigniter 2
                                </label>
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                <label>
                                    <input type="radio" name="versici" id="3" value="3" <?php echo $def_versi == '3' ? 'checked' : ''; ?>>
                                    Codeigniter 3
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-bottom: 5px; margin-top: 5px">
                    <?php $def_jenistable = isset($_POST['jenistabel']) ? $_POST['jenistabel'] : 'regtable'; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                <label>
                                    <input type="radio" name="jenistabel" id="regtable" value="regtable" <?php echo $def_jenistable == 'regtable' ? 'checked' : ''; ?>>
                                    Reguler Table
                                </label>
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                <label>
                                    <input type="radio" name="jenistabel" id="datatables" value="datatables" <?php echo $def_jenistable == 'datatables' ? 'checked' : ''; ?>>
                                    Datatables
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-bottom: 5px; margin-top: 5px">
                    <div class="checkbox">
                        <?php $excel = isset($_POST['excel']) ? $_POST['excel'] : ''; ?>
                        <label>
                            <input type="checkbox" name="excel" value="create" <?php echo $excel == 'create' ? 'checked' : '' ?>>
                            Export Excel
                        </label>

                        <?php $word = isset($_POST['word']) ? $_POST['word'] : ''; ?>
                        <label>
                            <input type="checkbox" name="word" value="create" <?php echo $word == 'create' ? 'checked' : '' ?>>
                            Export Word
                        </label>
                    </div>
                    <hr style="margin-bottom: 5px; margin-top: 5px">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="controllers" value="1" <?php echo isset($_POST['controllers']) ? 'checked' : '' ?>>
                            Controller
                        </label>

                        <label>
                            <input type="checkbox" name="models" value="1" <?php echo isset($_POST['models']) ? 'checked' : '' ?>>
                            Model
                        </label>

                        <label>
                            <input type="checkbox" name="views" value="1" <?php echo isset($_POST['views']) ? 'checked' : '' ?>>
                            View
                        </label>
                    </div>
                    <hr style="margin-bottom: 5px; margin-top: 5px">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="headers" value="1" <?php echo isset($_POST['headers']) ? 'checked' : '' ?>>
                            Header
                        </label>

                        <label>
                            <input type="checkbox" name="footers" value="1" <?php echo isset($_POST['footers']) ? 'checked' : '' ?>>
                            Footer
                        </label>
                    </div>
                    <hr style="margin-bottom: 5px; margin-top: 5px">
                    <div class="checkbox">
                        <?php $def_page = isset($_POST['paginationConfig']) ? $_POST['paginationConfig'] : ''; ?>
                        <label>
                            <input type="checkbox" name="paginationConfig" value="create" <?php echo $def_page == 'create' ? 'checked' : '' ?>>
                            Create ../application/config/pagination.php
                        </label>
                    </div>
                    <hr style="margin-bottom: 10px; margin-top: 10px">

                    <div class="form-group">
                        <label>Path output (Example ../application/)</label>
                        <input type="text" name="pathOutput" value="<?php echo isset($_POST['pathOutput']) ? $_POST['pathOutput'] : '' ?>" class="form-control" placeholder="Output files" />
                    </div>

                    <div class="form-group">
                        <label>Custom Controller Name</label>
                        <input type="text" id="controller" name="controller" value="<?php echo isset($_POST['controller']) ? $_POST['controller'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    <div class="form-group">
                        <label>Custom Model Name</label>
                        <input type="text" id="model" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    <input type="submit" value="Generate" name="generate" class="btn btn-primary pull-right" />
                </form>
                <?php
                echo $table_error;
                echo $model_res;
                echo $controller_res;
                echo $list_res;
                echo $read_res;
                echo $form_res;
                echo $page_res;
                echo $excel_res;
                echo $word_res;
                ?>
            </div>
        </div>
        <script type="text/javascript">
            function setname() {
                var table = document.getElementById('table').value.toLowerCase();
                document.getElementById('controller').value = table;
                document.getElementById('model').value = table + '_model';
            }
        </script>
    </body>
</html>


