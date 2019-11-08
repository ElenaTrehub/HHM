
<div  class="col-md-12" style="box-sizing: border-box;">
            <div class="create-personal" style="position: relative;">
                  <div style="width: 100%;" class="create-personal-header">
                    Projekt <?php echo ($this->project)?> aufgaben
                  </div>
                  <div class="row">
                        <div class="col-md-2" style="padding: 0;">
                            <div class="project-list">
                                <form action="/HR/edit" method="post">
                                        <?php foreach ($this->empList as $emp) : ?>
                                            <?php foreach ($this->taskList as $task) : ?>
                                                <?php if($emp->Id == $task->idEmployee && $task->Employee!="" && $task->Employee!="-1"){?>
                                                    <div class="project-calendar" onclick="this.parentNode.submit()" data-id=<?php print htmlentities($task->idEmployee); ?>>
                                                        <input type="hidden" name="idEmployee" value=<?php print htmlentities($task->idEmployee); ?>>
                                                        <?php print htmlentities($task->Employee); ?>
                                                    </div>
                                                <?php } ?>
                                                <?php if($emp->Id == $task->idEmployee && $task->Employee==""){?>
                                                    <div class="project-calendar-empty" onclick="this.parentNode.submit()" data-id=<?php print htmlentities($task->idEmployee);?> data-emptytaskid=<?php print htmlentities($task->idTask); ?>>
                                                        <input type="hidden" name="idEmployee" value=<?php print htmlentities($task->idEmployee); ?>>
                                                    </div>
                                                <?php } ?>
                                                
                                                

                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-10" style="padding: 0;">
                                <div class="project-calendar-year">
                                    <?php foreach ($this->calendar as $calendar): ?>
                                            <?php foreach ($calendar->Year as $month): ?>
                                                        
                                                        <?php foreach ($month->MonthDays as $week): ?>
                                                            
                                                                    <?php foreach ($week as $day): ?>
                                                                        <div  class="project-cal-day" data-date=<?php echo ($day->Date) ?> data-weekday=<?php echo ($day->WeekDay) ?> data-today=<?php echo ($day->Today) ?> data-holiday=<?php echo ($day->Holiday) ?>>
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
                                            <form action="/HR/EditTask" method="post">
                                                <div class="task" onclick="this.parentNode.submit()" data-status="<?php print htmlentities($task->StatusTask); ?>" data-id=<?php print htmlentities($task->idEmployee); ?> data-start=<?php echo ($task->TaskStart) ?> data-end=<?php echo ($task->TaskEnd) ?> data-task=<?php echo ($task->idTask) ?>>
                                                        <input type="hidden" name="idTask" value=<?php print htmlentities($task->idTask); ?>>
                                                        <?php print htmlentities($task->TaskTitle); ?>
                                                </div>
                                            </form>
                                         <?php endforeach; ?>
                                </div>
                            
                  
                        </div>
                                
                        </div>

                        

                  </div>
                  
            </div>
            
</div>






<script src="/HR/js/task-calendar.js"></script>