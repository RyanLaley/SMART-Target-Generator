<script>
	function resetForm(){
		$(".more").hide();
		$("#targetSubCategoryGroup").hide();
		$(".targetRenderArea").hide();
	}	
</script>

<form style="border:1px solid #333; padding:5px;">
	<div class="form-group">
		<!-- 1 - Student Details Section -->
		<div class="row">
			<frameset>
			<div class="col-sm-6">
				<div class="form-group">
					<label>This target is written by: </label>
					<label class="radio-inline"><input type="radio" id="targetUserTutor" name="targetUser" value="tutor">Tutor</label>
					<label class="radio-inline"><input type="radio" id="targetUserStudent" name="targetUser" value="student" checked>Student</label>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group studentName" style="display:none;">
					<label>Student Forename:</label>
					<input type="text" name="studentName" id="studentName" placeholder="(e.g. Alex)" required />
				</div>
			</div>
			</frameset>
		</div>
		<!-- 2 - Categories Section -->
		<div class="row" id="categories">
			<frameset>
			<div class="col-sm-6">
				<div class="form-group" id="targetCategoryGroup">
					<label for="targetCategory">Category: </label>
				  	<select class="form-control" id="targetCategory">
						<option value=""></option>
						<option value="attendance">Attendance</option>
						<option value="behaviour">Behaviour</option>
						<option value="assessment">Assessment</option>
						<option value="grade">Grade</option>
						<option value="task">Task</option>
				  	</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group" id="targetSubCategoryGroup" style="display:none;">
					<label for="targetSubCategory">Sub-Category: </label>
				  	<select class="form-control" id="targetSubCategory">
						<option value=""></option>
				  	</select>
				</div>
			</div>
			</frameset>
		</div>
		<!-- 3 - More Information Section -->
		<div class="row moreInfo">
			<frameset>
			<div class="col-sm-6">
				<div class="form-group more moreAssessment" style="display:none">
					<label for="moreInfo1">Which specific assessment:</label>
					<input type="text" class="form-control" id="MoreInfo1" placeholder="(e.g. Research Techniques Assignment 2)"/>
				</div>
				<div class="form-group more moreSubjectGrade" style="display:none">
					<label for="moreInfo1">Which specific subject:</label>
					<input type="text" class="form-control" id="MoreInfo1" placeholder="(e.g. GCSE English)"/>
				</div>
				<div class="form-group more moreTask" style="display:none">
					<label for="moreInfo1">What is the task to be completed:</label>
					<input type="text" class="form-control" id="MoreInfo1" placeholder="(e.g. edit a 10 second scene for a music video)"/>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group more moreSubjectGrade" style="display:none">
					<label for="moreInfo2">What specific grade:</label>
					<input type="text" class="form-control" id="MoreInfo2" placeholder="(e.g. grade C)"/>
				</div>
				<div class="form-group more moreTask" style="display:none">
					<label for="moreInfo2">Briefly, how will you know when the task is complete:</label>
					<input type="text" class="form-control" id="MoreInfo2" placeholder="(e.g. a video file of the completed clip)"/>
				</div>
			</div>
			</frameset>
		</div>
		<!-- 4 - Dates and Deadlines -->
		<div class="row deadline">
			<frameset>
			<div class="col-sm-6">
				<label for="reviewDate">Target Review Date:</label>
				<select class="form-control" id="reviewDate">
					<option value=""></option>
					<option value="1week">in one week</option>
					<option value="2weeks">in two weeks</option>
					<option value="month">at the end of the month</option>
					<option value="term">at the end of the current term</option>
				</select>
			</div>
			<div class="col-sm-6">
			</div>
			</frameset>
		</div>
		<!-- 5 - Submit and Clear Buttons -->
		<div class="form-group">
			<br />
			<input type="button" class="btn btn-default" id="renderTarget" value="Submit">
			<button type="reset" class="btn btn-default" onClick="resetForm()">Clear and Restart</button>
		</div>
		<!-- 6 - Render Target Area -->
		<div class="row targetRenderArea" style="display:none;">
			<div class="col-sm-12">
				<label for="targetRender">SMART Target:</label>
	  			<div class="well" rows="5" id="targetRender"></div>
			</div>
		</div>
	</div>
</form>


<script>
$(document).ready(function(){
	//Toggle the text field for the student name
	$("#targetUserStudent").click( function(){
		$(".studentName").fadeOut();
	});
	$("#targetUserTutor").click( function(){
		$(".studentName").fadeIn();
	});	
	
	//Toggle the Sub-Category dropdown based on the main category choice
	$("#targetCategory").change(function() {
		var dropdown = $("#targetCategory");
		var data = '{"attendance": "Improve&nbsp;Attendance, Improve&nbsp;Punctuality","behaviour": "Follow&nbsp;Instructions, Avoid&nbsp;Distraction","assessment": "Submit&nbsp;a&nbsp;Late&nbsp;Assessment, Resubmit&nbsp;an&nbsp;Assessment"}';
		var json = JSON.parse(data);
		var key = dropdown.val();
		var vals = [];
		switch(key) {
			case 'attendance':
				$(".more").hide();
				$(".moreInfo").hide("fast");
				$("#targetSubCategoryGroup").show("fast");
				vals = json.attendance.split(",");
				break;
			case 'behaviour':
				$(".more").hide();
				$(".moreInfo").hide("fast");
				$("#targetSubCategoryGroup").show("fast");
				vals = json.behaviour.split(",");
				break;
			case 'assessment':
				$(".more").hide();
				$(".moreInfo").show("fast");
				$(".moreAssessment").show("fast");
				$("#targetSubCategoryGroup").show("fast");
				vals = json.assessment.split(",");
				break;
			case 'grade':
				$(".more").hide();
				$(".moreInfo").show("fast");
				$(".moreSubjectGrade").show("fast");
				$("#targetSubCategoryGroup").hide("fast");
				break;
			case 'task':
				$(".more").hide();
				$(".moreInfo").show("fast");
				$(".moreTask").show("fast");
				$("#targetSubCategoryGroup").hide("fast");
				break;
			default:
				$(".more").hide();
				$(".moreInfo").hide("fast");
				$("#targetSubCategoryGroup").hide("fast");
				break;
		}
		var secondChoice = $("#targetSubCategory");
		secondChoice.empty();
		var i = 0;
		$.each(vals, function(index, value) {
			secondChoice.append("<option value="+i+">" + value + "</option>");
			i++;
		});
	});
	
	$("#renderTarget").click(function(){
		$(".targetRenderArea").show("fast");
		$("#targetRender").empty();
		var $studentName = $("#studentName").val();
		var $targetType = $("#targetCategory").val();
		var $targetDate = $("#reviewDate option[value='"+$("#reviewDate").val()+"']").text();
		var $targetCompSubCat = $("#targetSubCategory").val();
		var $targetRender = "";
		var $user = $("input[type='radio'][name='targetUser']:checked").val();
		if($user=="tutor"){
			switch($targetType){
			case "attendance":
					switch($targetCompSubCat){
					case '0':
						$targetRender = $studentName+" will achieve 90% attendance of all of their sessions "+$targetDate+". This will be reviewed via register system and tutor feedback.";
						break;
					case '1':
						$targetRender = $studentName+" will be outside of every session, 5 minutes before the start. This means "+$studentName+", "+$targetDate+" will be on time for the start of every session. This will be reviewed through tutor feedback.";
						break;
					default:
					}
				break;
			case "behaviour":
				switch($targetCompSubCat){
					case '0':
						$targetRender = $studentName+" is to follow the instructions of the tutor for all of the sessions and behave according to the student code of conduct. This will be reviewed via weekly reports from each of their tutors and "+$targetDate+" this will be reviewed.";
						break;
					case '1':
						$targetRender = $studentName+" is to not be the source of distraction in the session. They will follow tutor instructions and act in accordance to the student code of conduct. This will be reviewed each session by tutors and "+$targetDate+" this will be evaluated by "+$studentName+"'s personal tutor "+$targetDate+".";
						break;
					default:
				}
				break;
			case "assessment":
				$targetCompAss = $('.moreAssessment #MoreInfo1').val();
				switch($targetCompSubCat){
					case '0':
						$targetRender = $studentName+" has missed a deadline for "+$targetCompAss+" this is to be submitted as a late submission "+$targetDate+". This target is complete when "+$studentName+"'s tutor receives the completed assessment.";
						break;
					case '1':
						$targetRender = $studentName+" is to resubmit "+$targetCompAss+". This is to be submitted "+$targetDate+". This target is complete when "+$studentName+"'s tutor receives the completed assessment.";
						break;
					default:
				}
				break;
			case "grade":
				$targetCompSub = $(".moreSubjectGrade #MoreInfo1").val();
				$targetCompGrade = $(".moreSubjectGrade #MoreInfo2").val();
				$targetRender = $studentName+" is to achieve a "+$targetCompGrade+" in "+$targetCompSub+" "+$targetDate+". This will be reviewed through grades entered via "+$studentName+"'s mark book.";
				break;
			case "task":
				$targetCompTask = $(".moreTask #MoreInfo1").val();
				$targetCompEvi = $(".moreTask #MoreInfo2").val();
				$targetRender = $studentName+" is to "+$targetCompTask+". This will be evidenced via the submission of "+$targetCompEvi+" to the tutor "+$targetDate+".";
				break;
		}
		} else {
			switch($targetType){
			case "attendance":
					switch($targetCompSubCat){
					case '0':
						$targetRender = "I will achieve 90% attendance of all of my sessions "+$targetDate+". This will be reviewed via register system and tutor feedback.";
						break;
					case '1':
						$targetRender = "I will be outside of every session, 5 minutes before the start. "+$targetDate+" This means I will be on time for the start of every session. This will be reviewed through tutor feedback and register system.";
						break;
					default:
					}
				break;
			case "behaviour":
				switch($targetCompSubCat){
					case '0':
						$targetRender = "I will follow the instructions of the tutor for all of the sessions and behave according to the student code of conduct. This will be reviewed via weekly reports from each of my tutors and "+$targetDate+" this will be reviewed.";
						break;
					case '1':
						$targetRender = "I will follow the instructions of the tutor and will not be the source of distraction in the session. This will be reviewed each session by tutors and "+$targetDate+" this will be evaluated by my personal tutor.";
						break;
					default:
				}
				break;
			case "assessment":
				$targetCompAss = $('.moreAssessment #MoreInfo1').val();
				switch($targetCompSubCat){
					case '0':
						$targetRender = "I have missed a deadline for "+$targetCompAss+" this is to be submitted as a late submission "+$targetDate+". This target is complete when my tutor receives the completed assessment.";
						break;
					case '1':
						$targetRender = "I am to resubmit "+$targetCompAss+". This is to be submitted "+$targetDate+". This target is complete when my tutor receives the completed assessment.";
						break;
					default:
				}
				break;
			case "grade":
				$targetCompSub = $(".moreSubjectGrade #MoreInfo1").val();
				$targetCompGrade = $(".moreSubjectGrade #MoreInfo2").val();
				$targetRender = "I am to achieve a "+$targetCompGrade+" in "+$targetCompSub+" "+$targetDate+". This will be reviewed through grades entered via my mark book.";
				break;
			case "task":
				$targetCompTask = $(".moreTask #MoreInfo1").val();
				$targetCompEvi = $(".moreTask #MoreInfo2").val();
				$targetRender = "I am to "+$targetCompTask+". This will be evidenced via the submission of "+$targetCompEvi+" to the tutor "+$targetDate+".";
				break;
		}
		}
		$("#targetRender").append($targetRender);
	});
});
</script>