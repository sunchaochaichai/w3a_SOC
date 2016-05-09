<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
     <div id="pad-wrapper" class="users-list">
      <div class="row-fluid header">
<div name="log" class="form-horizontal" >
<fieldset>

<!-- Form Name -->
<legend>修改任务信息</legend>


<?php
foreach($log_monitor_result as $log_monitor_item): ?>
<input id="id" name="id" value="<? echo $log_monitor_item['id']?>" class="input" type="text" style="display: none">
<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="task_name">任务名称</label>
  <div class="controls">
    <input id="task_name" name="task_name" value="<? echo $log_monitor_item['task_name'];?>" class="input" type="text">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="task_url">任务URL/IP地址</label>
  <div class="controls">
    <input id="task_url" name="task_url" value="<? echo $log_monitor_item['task_url']?>"  class="input-large" type="text">
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="task_service_type">日志类型</label>
  <div class="controls">
    <select id="task_service_type" name="task_service_type" style="height:29px" class="input-medium">
     <?php foreach($log_type_result as $log_type_item):
	echo '<option value="'.$log_type_item['id'].'">'.$log_type_item['log_type_name'].'</option>';
	endforeach;
     ?>
    </select>
  </div>
</div>

<?php endforeach; ?>
<!-- Button (Double) -->
<div class="control-group">
  <div class="controls">
    <a id="button1id" name="button1id" class="btn btn-primary" onclick="postform();">提交</a>
    <a id="button2id" name="button2id" class="btn btn-info" onclick="goToUrl('/log_monitor_index/log_monitor_list');">返回</a>
  </div>
</div>

</fieldset>
</div>
</div>
</div>
    <script type="text/javascript">
     function postform(){
	var task_n=$('#task_name').val();
	var task_u=$('#task_url').val();
	var task_t=$('#task_service_type').val();
	var task_i=$('#id').attr('value');
	if(checkFrom(task_u)){
		$.ajax({
			type:'POST',
			url:'<?=site_url().'/Admin/log_monitor_index/log_monitor_update'?>',
			data:{id:task_i,task_name:task_n,task_url:task_u,task_service_type:task_t},
			dataType:'text',
			timeout:15000,
			success:function(){
				goToUrl('/log_monitor_index/log_monitor_list');
			},error:function(){
				alertWaring("更新信息失败","可能由于数据库连接失效，或填写有误导致无法更新信息，请检查数据库链接代码，以及提交的数据.");
			}
		});  
     	}

     }
    function checkFrom(url){
	if(IsURL(url)){
	   return true;
	}else{
	   alertWaring("输入有误!",'您的输入有误,请输入合法的URL/IP地址!');
	   return false;
	}
    }
    function IsURL(str_url){
        var strRegex = "^((https|http)?://)" 
        + "(([0-9]{1,3}.){3}[0-9]{1,3}"  
        + "|" 
        + "([0-9a-z_!~*'()-]+.)*"  
        + "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]." 
        + "[a-z]{2,6})" 
        + "(:[0-9]{1,4})?"  
        + "((/?)|"  
        + "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$"; 
        var ipRegex =re=/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/;
        var re=new RegExp(strRegex); 
        var re2=new RegExp(ipRegex);
        if (re.test(str_url)){
            return true; 
        }else{
            if(re2.test(str_url)){
                if( RegExp.$1<256 && RegExp.$2<256 && RegExp.$3<256 && RegExp.$4<256){
                        return true;
                }else{
                        return false;
                }
            }
        }
    }
    </script>
</body>
</html>
