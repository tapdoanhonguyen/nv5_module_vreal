<!-- BEGIN: main -->
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr class="text-center">
				<th class="w100">{LANG.weight}</th>
				<th class="w100">ID</th>
				<th>{LANG.name}</th>
				<th>{LANG.adddefaultblock}</th>
				<th class="w100"></th>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN: loop -->
			<tr>
				<td class="text-center">
				<select class="form-control" id="id_weight_{ROW.bid}" onchange="nv_chang_real_block('{ROW.bid}','weight');">
					<!-- BEGIN: weight -->
					<option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.title}</option>
					<!-- END: weight -->
				</select></td>
				<td class="text-center"><b>{ROW.bid}</b></td>
				<td><a href="{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}&amp;bid={ROW.bid}">{ROW.title}{ROW.numnews}</a></td>
				<td class="text-center">
				<select class="form-control" id="id_adddefault_{ROW.bid}" onchange="nv_chang_real_block('{ROW.bid}','adddefault');">
					<!-- BEGIN: adddefault -->
					<option value="{ADDDEFAULT.key}"{ADDDEFAULT.selected}>{ADDDEFAULT.title}</option>
					<!-- END: adddefault -->
				</select></td>
				<td class="text-center"><i class="fa fa-edit">&nbsp;</i><a href="{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}&amp;bid={ROW.bid}#edit">{GLANG.edit}</a> &nbsp;-&nbsp;<i class="fa fa-trash-o">&nbsp;</i><a href="javascript:void(0);" onclick="nv_del_real_block({ROW.bid})">{GLANG.delete}</a></td>
			</tr>
			<!-- END: loop -->
		</tbody>
	</table>
</div>
<!-- END: main -->