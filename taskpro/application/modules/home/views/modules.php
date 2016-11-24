  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
    <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
             <?php echo $title;?>
            </div>
        <div class="box-body">
          <?php echo $sub_title;?>
           <?php if($message){?>
              <div class="span4 offset4 alert alert-success text-center"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                 <p><?php echo $message;?></p>
              </div>
              <?php } ?>
          <div class="row">
           <div class="col-md-6">
          <fieldset>
            <legend>
              Generate CRUD 
            </legend>
            <?php echo form_open('home/generate_module');?>
            <div class="form-group">
                        <label>Select Table - <a href="<?php echo $_SERVER['PHP_SELF'] ?>">Refresh</a></label>
                        <select id="table_name" name="table_name" class="form-control" onchange="setname()">
                            <option value="">Please Select</option>
                            <?php
                          /*  $table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';*/
                            foreach ($table_list as $table) {
                                ?>
                               <option value="<?php echo $table;?>"><?php echo $table;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
            <div class="form-group">
                        <div class="row">
                            <?php $jenis_tabel = isset($_POST['jenis_tabel']) ? $_POST['jenis_tabel'] : 'reguler_table'; ?>
                            <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="jenis_tabel" value="reguler_table" <?php echo $jenis_tabel == 'reguler_table' ? 'checked' : ''; ?>>
                                        Reguler Table
                                    </label>
                                </div>                            
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="jenis_tabel" value="datatables" <?php echo $jenis_tabel == 'datatables' ? 'checked' : ''; ?>>
                                        Datatables
                                    </label>
                                </div>
                            </div>
                        </div> -->
                    </div>

                 <!--    <div class="form-group">
                        <div class="checkbox">
                            <?php $export_excel = isset($_POST['export_excel']) ? $_POST['export_excel'] : ''; ?>
                            <label>
                                <input type="checkbox" name="export_excel" value="1" <?php echo $export_excel == '1' ? 'checked' : '' ?>>
                                Export Excel
                            </label>
                        </div>
                    </div>    

                    <div class="form-group">
                        <div class="checkbox">
                            <?php $export_word = isset($_POST['export_word']) ? $_POST['export_word'] : ''; ?>
                            <label>
                                <input type="checkbox" name="export_word" value="1" <?php echo $export_word == '1' ? 'checked' : '' ?>>
                                Export Word
                            </label>
                        </div>
                    </div>  -->   
                     <div class="form-group">
                        <label>Custom Controller Name</label>
                        <input type="text" id="controller" name="controller" value="<?php echo isset($_POST['controller']) ? $_POST['controller'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    <div class="form-group">
                        <label>Custom Model Name</label>
                        <input type="text" id="model" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    <input type="submit" value="Generate" name="generate" class="btn btn-primary" onclick="javascript: return confirm('This will overwrite the existing files. Continue ?')" />
                <?php echo form_close();?>
                <br>

            <!--     <?php
                foreach ($hasil as $h) {
                    echo '<p>' . $h . '</p>';
                }
                ?> -->
          </fieldset>
        </div>
           
              <div class="col-md-6">
               <fieldset>
                <legend>Setting Generate Folder</legend>
                <?php echo form_open('home/settgenerate');?>
                    <div class="form-group">
                        <label>Target Folder</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="target" checked value="application/" >
                                    application/
                                    </label>
                                </div>                            
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="target" value="output/">
                                        output/
                                    </label>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <input type="submit" value="Save" name="save" class="btn btn-primary" />
               <?php echo form_close();?>
                </fieldset>
            </div>
             <div class="col-md-6">
             
             <fieldset>
                 <legend> Backup Database </legend>
        
                <a href="<?php echo base_url('home/backup');?>" name="backup" class="btn btn-primary" />
                Backup</a>
             </fieldset>
             </div>
        </div>
       </div>
       </div>
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <script type="text/javascript">
            function capitalize(s) {
                return s && s[0].toUpperCase() + s.slice(1);
            }

            function setname() {
                var table_name = document.getElementById('table_name').value.toLowerCase();
                if (table_name != '') {
                    document.getElementById('controller').value = capitalize(table_name);
                    document.getElementById('model').value = capitalize(table_name) + '_model';
                } else {
                    document.getElementById('controller').value = '';
                    document.getElementById('model').value = '';
                }
            }
        </script>