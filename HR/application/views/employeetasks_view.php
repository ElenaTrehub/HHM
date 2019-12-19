<div  class="col-md-12" style="box-sizing: border-box;">
            <div class="create-personal" style="position: relative;">
                  <div style="width: 100%; clear: both;" class="create-personal-header">
                    Mitarbeiter <?php echo ($this->employee)?> aufgaben
                    <span id="errorField"><?php echo ($this->upload_err);?></span>
                    <input value="Änderungen speichern"  onclick="SaveEmployeeTaskDate(<?php print htmlentities($this->idEmployee); ?>)" class="save-task-date" >
                  </div>
                  
                  <div class="row">
                        <div class="col-md-2" style="padding: 0;">
                            <div class="project-list">
                                <form action="/HR/editproject" method="post">
                                        <?php foreach ($this->projectList as $project) : ?>
                                            <?php foreach ($this->taskList as $task) : ?>
                                                <?php if($project->id == $task->idProject && $task->Info!="" && $task->Info!="-1"){?>
                                                    <div class="project-calendar" onclick="this.parentNode.submit()" data-id=<?php print htmlentities($task->idProject); ?>>
                                                        <input type="hidden" name="idProject" value=<?php print htmlentities($task->idProject); ?>>
                                                        <?php print htmlentities($task->Project); ?>
                                                    </div>
                                                <?php } ?>
                                                <?php if($project->id == $task->idProject && $task->Info==""){?>
                                                    <div class="project-calendar-empty" onclick="this.parentNode.submit()" data-id=<?php print htmlentities($task->idProject); ?> data-emptytaskid=<?php print htmlentities($task->idTask); ?>>
                                                        <input type="hidden" name="idProject" value=<?php print htmlentities($task->idProject); ?>>
                                                    </div>
                                                <?php } ?>
                                                
                                                

                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-10 row-for-resize" style="padding: 0;">
                                <div class="project-calendar-year">
                                    <?php foreach ($this->calendar as $calendar): ?>
                                            <?php foreach ($calendar->Year as $month): ?>
                                                        
                                                        <?php foreach ($month->MonthDays as $week): ?>
                                                            
                                                                    <?php foreach ($week as $day): ?>
                                                                        <div  class="project-cal-day" data-date="<?php echo ($day->Date) ?>" data-weekday="<?php echo ($day->WeekDay) ?>" data-today="<?php echo ($day->Today) ?>" data-holiday="<?php echo ($day->Holiday) ?>">
                                                                            <div class="year">
                                                                                <?php echo ($month->Year)?>
                                                                            </div >
                                                                            <div class="month">
                                                                                <?php echo ($month->MonthHeader)?>
                                                                            </div >
                                                                            <div class="day">
                                                                                <?php echo ($day->Date . " " . $day->WeekDayName) ?>
                                                                            </div >
                                                                            
                                                                            
                                                                        </div>
                                                                    <?php endforeach?>

                                                        <?php endforeach?>
                                                    
                                            <?php endforeach?>
                                        <?php endforeach?>
                                        <?php foreach ($this->taskList as $task) : ?>
                                            
                                                <div class="task"  data-status="<?php print htmlentities($task->StatusTask); ?>"  data-id=<?php print htmlentities($task->idProject); ?> data-start=<?php echo ($task->TaskStart) ?> data-end=<?php echo ($task->TaskEnd) ?> data-task=<?php echo ($task->idTask) ?>>
                                                        <div class="edit-task">
                                                            <form action="/HR/EditTask" method="post">
                                                                <input type="hidden" name="idTask" value=<?php print htmlentities($task->idTask); ?>>
                                                                <button type="submit" >&#9997; &ensp;</button>
                                                            </form>
                                                        </div>
                                                        <div style="display: inline-block;">
                                                            <?php print htmlentities($task->TaskTitle); ?>
                                                        </div>

                                                        

                                                        <div style="position: relative; width: 100%;">
                                                            <div onmousedown="ResizeLeftTask(this, event)" class="resize-left">&#8660;</div>
                                                            <div onmousedown="ResizeRightTask(this, event)" class="resize-rigth">&#8660;</div>
                                                        </div>
                                                </div>
                                            
                                         <?php endforeach; ?>
                                </div>
                            
                  
                        </div>
                                
                        </div>

                        

                  </div>
                  
            </div>
            
</div>






<script src="/HR/js/task-calendar.js"></script>