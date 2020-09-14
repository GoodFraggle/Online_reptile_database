<?php 
								$getanimaldata = DB::getInstance()->query("SELECT * FROM newAnimals");

								if (empty($getanimaldata)):
									echo "<p>No species at the moment.</p>";
								else:
							  ?>
								<table>
									<thead>
										<tr>
											<th>Viv number</th>
											<th>Morph</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										
										foreach($getanimaldata->results() as $getanimaldata): ?>
											<tr>
												<td><?php echo e($getanimaldata->morph);?></td>
												<td><?php echo e($getanimaldata->sex);?></td>
												<td><a href="<?php echo BASE_URL; ?>/admin/imageuploads.php?link=<?php echo e($getanimaldata->id);?>">add Images</a></td>
												<td></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							<?php endif; ?>