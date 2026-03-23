<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">List of FAQs</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="35%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Question</th>
						<th>Answer</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `faqs` order by `question` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo $row['question'] ?></td>
							<td class="text-truncate" style="max-width: 250px;"><?php echo strip_tags($row['answer']) ?></td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge bg-success px-3 rounded-pill">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger px-3 rounded-pill">Inactive</span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								<div class="dropdown">
									<button type="button" class="btn btn-flat p-1 btn-default btn-sm border dropdown-toggle dropdown-icon" data-bs-toggle="dropdown">
											Action
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="bi bi-pencil-square text-primary"></span> Edit</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="bi bi-trash text-danger"></span> Delete</a>
									</div>
								</div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(document).on('click', '.delete_data', function(){
			_conf("Are you sure to delete this FAQ permanently?","delete_faq",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Add New FAQ","faqs/manage_faq.php", "mid-large")
		})
		$(document).on('click', '.edit_data', function(){
			uni_modal("<i class='fa fa-edit'></i> Update FAQ Details","faqs/manage_faq.php?id="+$(this).attr('data-id'), "mid-large")
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [4,5] }
			],
			order:[0,'asc']
		});
		$(document).on('click', '.view_data', function(){
			uni_modal("FAQ Details","faqs/view_faq.php?id="+$(this).attr('data-id'))
		})
	})
	function delete_faq($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_faq",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
