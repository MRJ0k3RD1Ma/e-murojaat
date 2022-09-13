
<!-- Modal -->
<div id="modaltashkilot" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Топшириқ бериш</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ёпиш</button>
            </div>
        </div>

    </div>
</div>



<style>
    .table.table-hover.table-bordered.datatable_tashkilot.dataTable.no-footer{
        width: 100% !important;
    }
</style>


<?php
$url = Yii::$app->urlManager->createUrl(['/appeal/task','regid'=>$register->id]);
$this->registerJs("
        $(document).ready(function(){
              $('.datatable_tashkilot').DataTable({
                \"processing\": true,
                \"serverSide\": true,

                \"ajax\": {
                    \"url\":\"/get/gettashkilot\",
                    \"type\":\"post\"
                },
                \"columns\": [
                    { \"data\": \"id\" },
                    { \"data\": \"name\" },
                    { \"data\": \"director\" },
                    { \"data\": \"inn\" }
                ],
            });
        })
        
        tashkilotadd = function(id){
            $('#modaltashkilot').modal('show').find('.modal-body').load('{$url}&id='+id);
        }     
        
        $('.datatable_emp').DataTable(); 
        
        taskemployee = function(url){
            $('#modaltashkilot').modal('show').find('.modal-body').load(url);
        }
        
        
    ")
?>