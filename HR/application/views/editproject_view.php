<div class="create-body2">
    <div class="row">
        <div class="button-container col-md-12">
            <input data-toggle="modal" value="Projekt hinzufügen" data-target="#addModal" id="project-add" class="add-project-btn" >
            <div style="display: inline-block; width:600px;">
                <form action="/HR/editproject" method="post" style="display: flex"> 
                    <input list="Projects" autocomplete="off" placeholder="Wählen Sie ein Projekt" name="numberProject" onchange = submit(); class="choose-project"
                        value="<?php if($this->projectId!= ''){      
                            echo $this->project->Number; 
                        }else{echo '';} 
                        ?>">
                        <datalist id="Projects">
                            <?php if(isset($this->projects[0])){
                                foreach($this->projects as $proj){
                                    print '<option type="submit"  value=' . $proj->project->Number . '>' . $proj->project->Number . '</option>';
                                }
                            } ?>
                        </datalist>
                        <!-- <button class="button_choose-project" type="submit">Projekt auswählen</button> -->
                </form>
            </div>
            
        </div>   
    </div>

    <?php if($this->projectId!= ''){?>
        <div class="row">
            <div class="col-md-12">
                <form  action="/HR/updateproject" method="post" enctype="multipart/form-data">
                    <div id="personal-details" style="max-width: 99%;" class="col-md-12">
                        <div id="personal-details-header" class="create-personal-header">Darsteller im Projekt</div>
                            <input  type="hidden" name="id" value=<?php echo ($this->projectId); ?>>
                            <?php if($this->upload_err!=""){?>
                                <span id="errorField"><?php echo ($this->upload_err);?></span>
                                <?php } ?>
                            <div class="row">                    
                                    <input id="empInProjectInput" autocomplete="off" list="Employees" placeholder="Wählen Sie einen Mitarbeiter" class="choose-employee">
                                        <datalist id="Employees">
                                            <?php if(isset($this->employees[0])){
                                                foreach($this->employees as $emp){
                                                    print '<option data-value=' . $emp->Id . '>' . $emp->Name . " ". $emp->LastName . " - ". $emp->Position . '</option>';
                                                }
                                            } ?>
                                        </datalist>
                                        
                                        <button id="AddEmpButton" type="button" style="line-height:40px;"  id="btn-employee-add" name="AddEmployeeButton" class="add-employee-btn" ></button>
                                      
                            </div>
                            <div>
                            <label class="employee-label">Arbeiter im Projekt</label>
                            <div id="empInProjectPlaceholder"> 
                                    <?php $employeeCounter = 0?>
                                    <?php if (isset($this->employeesInProject[0])) : ?>
                                        
                                            <?php foreach($this->employeesInProject as $emp):?>
                                            <?php $employeeCounter++?>
                                            <div class="emp-in-project">
                                            <div onmousedown="addEmployeeToTask(this)"  class="add-employee-project exist-emp-proj">
                                            
                                                <div>
                                                        <input type="text" name=<?php print htmlentities("employeeInProj[Info_".$employeeCounter."]")?>
                                                            value = "<?php echo($emp->Name .' '. $emp->LastName .' - '. $emp->Position); ?>">
                                                </div>
                                                
                                                <button id="btnEmpFromProjRemove" data-id="<?php echo($emp->Id);?>" data-current="<?php echo($emp->Is_Busy_Current);?>" class="btn btn-danger" type="button"   onmousedown="DeleteEmployeeFro(this, event)" style="margin-top:4px; margin-right:5px; width: 30px; height: 30px; line-height:10px; font-size: 12px; padding: 0; border-radius: 15px; float:right;">&#10006</button>
                                            </div>
                                            <?php if ($emp->Is_Busy == 0 && $emp->Is_Busy_Current == 0){ ?>
                                                <div class="emp-free"><?php echo $emp->Emp_Busy; ?></div>
                                            <?php } else if ($emp->Is_Busy_Current == 1){ ?>
                                                <div class="emp-busy-current"><?php echo $emp->Emp_Busy; ?></div>
                                           
                                            <?php } else if ($emp->Is_Busy == 1){ ?>
                                                <div class="emp-busy"><?php echo $emp->Emp_Busy; ?></div>
                                            <?php }?>
                                            </div>
                                        <?php endforeach?>
                                    
                                    
                                        
                                    
                                    <?php endif; ?>
                                    
                              </div>
                              <input type="submit" value="Genehmigen"  id="emp-to-project-add" class="add-emp-btn" >


                            </div>



                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                
                <div class="col-md-12">
                    <div id="personal-details" class="col-md-12" style="max-width: 99%; margin-top: 30px;" class="col-md-12">
                        <div id="personal-details-header" class="create-personal-header">Projekt ziele</div>
                        <div class="row">
                            <div class="button-container col-md-2">
                                <input data-toggle="modal" value="Aufgabe hinzufügen" data-target="#addModalTask" id="task-add" class="add-project-btn" >
                            </div>
                            <div class="button-container col-md-10"> 
                                <form  action="/HR/tasklist" method="post" enctype="multipart/form-data">
                                    <input  type="hidden" name="idProject" value=<?php echo ($this->projectId); ?>>
                                    <input value="Projekt diagramm" type="submit" class="diagramm-btn" >
                                </form>
                            </div>   
                            
                        </div>
                        <form  action="/HR/updatetasksinproject" method="post" enctype="multipart/form-data">
                        
                        <div class="tasks">
                            
                            <div class="current-task">
                                <div class="task-status-title">Aktuelle Aufgaben</div>
                                    <div class="tasks-container">
                                    <?php if($this->upload_task_err!=""){?>
                                        <span id="errorTaskField"><?php echo ($this->upload_task_err);?></span>
                                    <?php } ?>
                                    <?php $taskCounter=0?>
                                    <input  type="hidden" name="idProject" value=<?php echo ($this->projectId); ?>>
                                        <?php foreach ($this->tasks as $task) : ?>
                                        
                                            
                                            <?php if($task->StatusTask == 'Current'){?>

                                                <?php $taskCounter++?>




                                                <div class="task-info current-task-item" data-id = <?php echo $task->idTask ?> data-employee ="<?php echo $task->Employee?>">
                                                    <?php if ($task->Is_Past != ""){ ?>
                                                        <div class="task-past"><?php echo $task->Is_Past; ?></div>
                                                    <?php } else if ($task->Is_Finish != ""){ ?>
                                                        <div class="task-finish"><?php echo $task->Is_Finish; ?></div>
                                                    <?php }?>
                                                    <input  type="hidden" name="<?php print htmlentities("taskInProj[idTask_".$taskCounter."]");?>" value="<?php echo ($task->idTask); ?>">
                                                    <input  type="hidden" name="<?php print htmlentities("taskInProj[TaskTitle_".$taskCounter."]");?>" value="<?php echo ($task->TaskTitle); ?>">
                                                    <input  type="hidden" value="<?php echo $task->TaskText ?>" name="<?php print htmlentities("taskInProj[TaskText_".$taskCounter."]");?>">
                                                    <input  type="hidden" name="<?php print htmlentities("taskInProj[TaskStart_".$taskCounter."]");?>" value="<?php echo ($task->TaskStart); ?>">
                                                    <input  type="hidden" name="<?php print htmlentities("taskInProj[TaskEnd_".$taskCounter."]");?>" value="<?php echo ($task->TaskEnd); ?>">
                                                    <input  type="hidden" name="<?php print htmlentities("taskInProj[Curator_".$taskCounter."]");?>" value="<?php echo ($task->Curator); ?>">
                                                    <input class="status-input"  type="hidden" name="<?php print htmlentities("taskInProj[Status_".$taskCounter."]");?>" value="Current">
                                                    <div id="<?php print htmlentities("Employee_".$taskCounter);?>"></div>


                                                    <div class="task-title"><?php echo $task->TaskTitle?></div>
                                                    <div class="task-date"><?php echo $task->TaskStart . " - " . $task->TaskEnd?></div>
                                                    <div class="task-description"><?php echo substr($task->TaskText, 0, 95)."..."?></div>
                                                    <?php if($task->idEmployee!=null){?>


                                                        <div class="add-employee-project">
                                                            <div>
                                                                    <input type="text" name=<?php print htmlentities("taskInProj[Employee_".$taskCounter."]")?>
                                                                        value = "<?php echo $task->Employee ?>">
                                                            </div>
                                                    
                                                            <button id="btnEmpFromTaskRemove" class="btn btn-danger" type="button" onclick="DeleteEmployeeFromTask(this)" data-counter="<?php echo $taskCounter?>" data-employee ="<?php echo $task->Employee?>"  data-id =<?php echo $task->idTask?> style="margin-top:4px; margin-right:5px; width: 30px; height: 30px; line-height:10px; font-size: 12px; padding: 0; border-radius: 15px; float:right">&#10006</button>
                                                        </div>
                                                    
                                                        <?php }else {?>
                                                        
                                           
                                                            <input  type="hidden" name="<?php print htmlentities("taskInProj[Employee_".$taskCounter."]")?>" value="-">


                                                        <?php }?>


                                                        <div data-id="<?php echo $task->idTask;?>" class="task-details" onclick="TaskDetails(this)">Details und Anpassung ...</div>
                                                        <div class="moov-task-to-finish">
                                                            <div  onclick="MoovTaskToFinished(this)">&#187;</div>
                                                        </div>
                                                       


                                                    <button id="btnTaskRemove" class="btn btn-danger" type="button" onclick="DeleteTask(this)" data-id = <?php echo $task->idTask ?> >&#10006</button>
                                                    
                                                </div>
                                            

                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </div>     
                            </div>

                            <div class="finished-task">
                                <div class="task-status-title">Abgeschlossene Aufgaben</div>
                                    <div class="tasks-container">
                                        <?php foreach ($this->tasks as $task) : ?>
                                            
                                            <?php if($task->StatusTask == 'Finished'){?>
                                                <?php $taskCounter++?>
                                                <div class="task-info">
                                                <input  type="hidden" name="<?php print htmlentities("taskInProj[idTask_".$taskCounter."]");?>" value="<?php echo ($task->idTask); ?>">
                                                    <input  type="hidden" name="<?php print htmlentities("taskInProj[TaskTitle_".$taskCounter."]");?>" value="<?php echo ($task->TaskTitle); ?>">
                                                    <input  type="hidden" value="<?php echo $task->TaskText ?>" name="<?php print htmlentities("taskInProj[TaskText_".$taskCounter."]");?>">
                                                    <input  type="hidden" name="<?php print htmlentities("taskInProj[TaskStart_".$taskCounter."]");?>" value="<?php echo ($task->TaskStart); ?>">
                                                    <input  type="hidden" name="<?php print htmlentities("taskInProj[TaskEnd_".$taskCounter."]");?>" value="<?php echo ($task->TaskEnd); ?>">
                                                    <input  type="hidden" name="<?php print htmlentities("taskInProj[Curator_".$taskCounter."]");?>" value="<?php echo ($task->Curator); ?>">
                                                    <input  class="status-input"type="hidden" name="<?php print htmlentities("taskInProj[Status_".$taskCounter."]");?>" value="Finished">


                                                        <div class="task-title"><?php echo $task->TaskTitle?></div>
                                                        <div class="task-date"><?php echo $task->TaskStart . " - " . $task->TaskEnd?></div>
                                                        <div class="task-description"><?php echo substr($task->TaskText, 0, 95)."..."?></div>
                                                        <?php if($task->idEmployee!=null){?>
                                                            <div class="add-employee-project">
                                                                <div>
                                                                        <input type="text" name=<?php print htmlentities("taskInProj[Employee_".$taskCounter."]")?>
                                                                            value = "<?php echo $task->Employee ?>">
                                                                </div>
                                                        
                                                                <button id="btnEmpFromTaskRemove" class="btn btn-danger" type="button" onclick="DeleteEmployeeFromTask(this)"data-employee = "<?php echo $task->Employee ?>"  data-id =  <?php echo $task->idTask ?>  style="margin-top:4px; margin-right:5px; width: 30px; height: 30px; line-height:10px; font-size: 12px; padding: 0; border-radius: 15px; float:right">&#10006</button>
                                                            </div>
                                                            <?php } else {?>
                                                                <input  type="hidden" name="<?php print htmlentities("taskInProj[Employee_".$taskCounter."]")?>" value="-">


                                                            <?php }?>
                                                            <div data-id="<?php echo $task->idTask;?>" class="task-details" onclick="TaskDetails(this)">Details und Anpassung ...</div>
                                                            <div class="moov-task-to-current">
                                                                <div  onclick="MoovTaskToCurrent(this)">&#171;</div>
                                                            </div>
                                                            
                                                            
                                                            
                                                            <button id="btnTaskRemove" class="btn btn-danger" type="button" onclick="DeleteTask(this)" data-id = <?php echo $task->idTask ?> >&#10006</button>
                                                    </div>

                                            <?php }?>
                                        <?php endforeach; ?>
                                    </div>   
                            </div>
                        </div>
                        <input type="submit" value="Aufgaben aktualisieren" name="emp-in-proj"  id="emp-to-project-add" class="add-emp-btn" >
                        </form>
                    </div>
                </div>
        </div>
        </div>
        
        
    <?php } ?>
    

    
</div>

<!-- <div class="modal fade" id="taskModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Drücken Sie Ja, um die Löschung zu bestätigen.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/HR/deletetask" method="post">
                <div class="modal-body">
                    <input type="hidden" id="idTaskInput" name="idTask" value="">
                    <button type="submit" class="btn btn-danger">Ja</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Abbrechen</button>
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div> -->

<!-- <div class="modal fade" id="empFromTaskModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Möchten Sie den Mitarbeiter wirklich von dieser Aufgabe entfernen?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/HR/deleteemployeefromtask" method="post">
                <div class="modal-body">
                    <input type="hidden" id="idTaskEmployeeInput" name="id" value="">
                    <input type="hidden" id="idEmployeeTaskInput" name="Employee" value="">
                    <button type="submit" class="btn btn-danger">Ja</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Abbrechen</button>
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div> -->
<div class="modal fade" id="bucketModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Drücken Sie Ja, um die Löschung zu bestätigen.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/HR/deleteproject" method="post">
                <div class="modal-body">
                    <input type="hidden" name="idProject" value=<?php print htmlentities($this->projectId); ?>>
                    <button type="submit" class="btn btn-danger">Ja</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Abbrechen</button>
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Füllen Sie das Formular aus, um ein neues Projekt hinzuzufügen.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="content-in-popup">
                <form action="/HR/updateproject" method="post" enctype="multipart/form-data">
                    <div class="col-md-12 personal-details-popup">
                        <div id="personal-details-header" class="create-personal-header">Project Details</div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id" value=<?php echo ($this->projectId); ?>>
                                <div>                                                
                                    <div class="bio-description">Name</div>
                                        <input type="text" name="Title" class="bio-value">
                                </div>
                                <div>                                                
                                    <div class="bio-description">Number</div>
                                        <input type="text" name="Number" class="bio-value">
                                </div>
                                <div class="create-personal-content">
                                    <div class="bio-description">Start</div>
                                        <input type="date" name="StartDate" class="bio-value">
                                </div>
                                <div class="create-personal-content">
                                    <div class="bio-description">End</div>
                                        <input type="date" name="EndDate" class="bio-value">
                                </div>
                                <div>                                                
                                    <div class="bio-description">Standort</div>
                                        <input type="text" name="Destination" class="bio-value">
                                </div>
                                <div>                                                
                                    <div class="bio-description">Beschreibung</div>
                                        <input type="text" name="Description" class="bio-value">
                                </div>

                                
                                <div>                       
                                    <div class="bio-description">Vorgesetzter</div>
                                        <input list="Curators" name="Curator" class="bio-value">
                                        <datalist id="Curators">
                                            <?php if(isset($this->curators[0])){
                                                foreach($this->curators as $cur){
                                                    print '<option data-value=' . $cur->idCurator . '>' . $cur->Name . " ". $cur->LastName .'</option>';
                                                }
                                            } ?>
                                        </datalist>
                                </div>
                                
                                <div>
                                    <div class="bio-description">Kunde</div>
                                        <input list="Clients" name="Client" class="bio-value">
                                            <datalist id="Clients">
                                                <?php if (isset($this->clients[0])){
                                                    foreach($this->clients as $client){
                                                            print "<option data-value='" . $client->idClient . "'>" . $client->Title . "</option>";
                                                    }
                                                } ?>
                                            </datalist>
                                </div>
                                <div>                       
                                    <div class="bio-description">Project status</div>
                                        <input list="Statuses" name="Status" class="bio-value">
                                        <datalist id="Statuses">
                                            <?php if(isset($this->statuses[0])){
                                                foreach($this->statuses as $status){
                                                    print '<option data-value=' . $status->idStatusProject . '>' . $status->statusProjectTitle .'</option>';
                                                }
                                            } ?>
                                        </datalist>
                                </div>
                                <div class="button-container">
                                    <input type="submit" id="btn-project-add" name="SaveButton" class="personal-categories-btn" value="Speichern">
                                    <a id="btn-project-cancel" class="personal-categories-btn" href="/HR/EditProject">Abbrechen</a>
                                    <?php if($this->projectId!= ''){ ?>     
                                                    <input data-toggle="modal" value="Löschen" data-target="#bucketModalDelete" id="btn-project-delete" class="personal-categories-btn" >
                                    <?php } ?>
                                    
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addModalTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Füllen Sie das Formular aus, um eine neue Aufgabe hinzuzufügen.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="content-in-popup">
                <form action="/HR/updatetask" method="post" enctype="multipart/form-data">
                    <div class="col-md-12 personal-details-popup">
                        <div id="personal-details-header" class="create-personal-header">Task Details</div>
                        <div class="row">
                            <div class="col-md-12">
                            <input type="hidden" name="idProject" value=<?php echo ($this->projectId); ?>>
                                <div>                                                
                                    <div class="bio-description">Name</div>
                                        <input type="text" name="Title" class="bio-value">
                                </div>
                                <div>                                                
                                    <div class="bio-description">Definition</div>
                                        <input type="text" name="Text" class="bio-value">
                                </div>
                                <div class="create-personal-content">
                                    <div class="bio-description">Start</div>
                                        <input type="date" name="StartDate" class="bio-value">
                                </div>
                                <div class="create-personal-content">
                                    <div class="bio-description">End</div>
                                        <input type="date" name="EndDate" class="bio-value">
                                </div>
                                
                                <!-- <div>                       
                                    <div class="bio-description">Darsteller</div>
                                        <input list="Employees" name="Employee" autocomplete="off" class="bio-value">
                                        <datalist id="Employees">
                                            <?php if(isset($this->employeesInProject[0])){
                                                foreach($this->employeesInProject as $emp){
                                                    print '<option data-value=' . $emp->Id . '>' . $emp->Name . " ". $emp->LastName . " - ". $emp->Position . '</option>';
                                                }
                                            } ?>
                                        </datalist>
                                </div> -->
                                <div>                       
                                    <div class="bio-description">Curator</div>
                                        <input list="Curators" name="Curator" class="bio-value">
                                        <datalist id="Curators">
                                            <?php if(isset($this->employees[0])){
                                                foreach($this->employees as $emp){
                                                    print '<option data-value=' . $emp->Id . '>' . $emp->Name . " ". $emp->LastName . " -  ". $emp->Position . '</option>';
                                                }
                                            } ?>
                                        </datalist>
                                </div>
                            
                                <div>                       
                                    <div class="bio-description">Task status</div>
                                        <input type="text" name="Status" class="bio-value" value="Current">
                                        <!-- <datalist id="TaskStatuses">
                                            <?php if(isset($this->task_statuses[0])){
                                                foreach($this->task_statuses as $status){
                                                    print '<option data-value=' . $status->idStatusTask . '>' . $status->statusTaskTitle .'</option>';
                                                }
                                            } ?>
                                        </datalist> -->
                                </div>

                                <div class="button-container">
                                    <input type="submit" id="btn-project-add" name="SaveButton" class="personal-categories-btn" value="Speichern">
                                    <a id="btn-project-cancel" class="personal-categories-btn" href="/HR/EditProject">Abbrechen</a>
                                    <?php if($this->projectId!= ''){ ?>     
                                                    <input data-toggle="modal" value="Löschen" data-target="#bucketModalDelete" id="btn-project-delete" class="personal-categories-btn" >
                                    <?php } ?>
                                    
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="empFromProjModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dieser Mitarbeiter hat noch offene Aufgaben im Projekt. Wenn Sie die Aufgabe löschen, 
                    werden Sie ohne Executor zurückgelassen. Möchten Sie diesen Mitarbeiter wirklich aus dem Projekt entfernen?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/HR/deleteemployeefromproject" method="post">
                <div class="modal-body">
                    <input type="hidden" name="idProject" value=<?php print htmlentities($this->projectId); ?>>
                    <input id="inputForDeleteEmpFromProject" type="hidden" name="idEmployee" value="0">
                    <button type="submit" class="btn btn-danger">Ja</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Abbrechen</button>
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div>


<div id="empInProjectTemplate" class="add-employee-project collapse">
        <div>                          
            <input type="text" name=<?php print htmlentities("employeeInProj[Info_1]")?> >
        </div>
        <!-- div>                          
            <input type="text" name=<?php print htmlentities("employeeInProj[LastName_1]")?> >
        </div>
        <div>                              
            <input type="text" name=<?php print htmlentities("employeeInProj[Position_1]")?>>
        </div> -->   
            <button id="btnEmpFromProjRemove" class="btn btn-danger" type="button" onclick="DeleteEmployeeFro(this)" style="margin-top:4px; margin-right:5px; width: 30px; height: 30px; line-height:10px; font-size: 12px; padding: 0; border-radius: 15px; float:right">&#10006</button>
    
</div>

<script src="/HR/js/projectDeleteConfirm.js"></script>