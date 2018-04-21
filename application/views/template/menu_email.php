 		  <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Template</h3>

              <div class="box-tools">
                <a href="<? echo base_url('email/addtemplate') ?>" id="add_template" class="btn btn-box-tool" ><i class="fa fa-plus"> Add Template</i></a>
                
              </div>
            </div>
             <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <!--<li><a href="mailbox.html"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">12</span></a></li>-->
                 <? foreach($row_template as $row)
				 	{ ?> 
                <li><a href="<? echo base_url('email/edittemplate/') . $row['template_id'] ?>"><i class="fa fa-clone"></i> <? echo $row['template_nama'] ?></a></li>
                 <? } ?>
                <!--
                <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li> -->
              </ul>
            </div>
            <!-- /.box-body -->
           
         </div>
          <!-- /.box -->
          
         <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Email Job</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
           
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <!--<li><a href="mailbox.html"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">12</span></a></li>-->
                <li><a href="<?   echo base_url('email/compose/') ?>"><i class="fa fa-envelope-o"></i> Compose </a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Sent Email</a></li>
                <!--
                <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li> -->
              </ul>
            </div>
            <!-- /.box-body -->
           
          </div>
          <!-- /.box -->