<div class="art-block">
    <div class="art-block-tl"></div>
    <div class="art-block-tr"></div>
    <div class="art-block-bl"></div>
    <div class="art-block-br"></div>
    <div class="art-block-tc"></div>
    <div class="art-block-bc"></div>
    <div class="art-block-cl"></div>
    <div class="art-block-cr"></div>
    <div class="art-block-cc"></div>
    <div class="art-block-body">
                <div class="art-blockheader">
                    <div class="l"></div>
                    <div class="r"></div>
                    <h3 class="t">Friends you may know</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
                <div>
				<p></p>
				  <ul>
					<?php
					
						$id = $_SESSION['member_id']; 
						$sql = mysqli_query($con,"SELECT * FROM friends WHERE (friends_with = '$id' OR member_id = '$id') AND status='c' LIMIT 0,1")or die(mysqli_error());
						while($rows = mysqli_fetch_array($sql)){
							$friends = $rows['member_id']; 
							$post = mysqli_query($con,"SELECT * FROM members WHERE member_id != '$friends' AND member_id != '$id' LIMIT 0,5 ")or die(mysqli_error());
							while ($row = mysqli_fetch_array($post)){
								$idf = $row['member_id'];
								$sql2 = mysqli_query($con,"SELECT * FROM friends WHERE (friends_with = '$id' AND member_id = '$idf' AND status='c') OR (friends_with = '$idf' AND member_id = '$id' AND status='c') ")or die(mysqli_error());
								if (mysqli_num_rows($sql2)==0){
								echo '
								<li>
									<p align="center"><a href="infofriend.php?id='.$row['member_id'].'" rel="facebox" style="text-decoration:none;" ><img src="image/members/'.$row['photo'].'" alt="" height="50" width="50" border="0" class="left_bt" />
									</br>'.$row['firstname']." ".$row['lastname'].'
									</br><a href="addfriend.php?id='.$row['member_id'].'" rel="facebox" style="text-decoration:none;"  >Add as Friend</a></p>
								</li>';
								}else{}
							}
						}
					?>
				 </ul>
</div>               
                                		<div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>