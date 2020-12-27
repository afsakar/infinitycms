<div class="widget-body p-b-0 table-container">
    <?php if($todo_unchecked || $todo_checked): ?>
    <ul class="todo-list">
        <?php foreach ($todo_unchecked as $item): ?>
            <li class="todo-item">
                <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="isActive" name="todo" data-url="<?php echo base_url("dashboard/todoCheck/$item->id")?>" <?=$item->isActive == 1 ? "checked" : ""?> id="todo<?=$item->id?>"/>
                    <label style="width: 100%;" for="todo<?=$item->id?>"><?=$item->title?> <button data-url="<?php echo base_url("dashboard/todoDelete/$item->id")?>" class="btn btn-xs btn-link text-danger pull-right remove-btn"><i class="fa fa-trash"></i></button></label>
                </div>
            </li><!-- .todo-item -->
        <?php endforeach; ?>
        <?php foreach ($todo_checked as $item): ?>
            <?php
            $today = date("Y-m-d H:i:s");
            $later = date('Y-m-d', strtotime('+5 days', strtotime($item->checkedAt)));
            if($today >= $later){
                $this->db->where(array("id" => $item->id))->delete("todo");
            }
            ?>
            <li class="todo-item">
                <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="isActive" name="todo" data-url="<?php echo base_url("dashboard/todoCheck/$item->id")?>" <?=$item->isActive == 1 ? "checked" : ""?> id="todo<?=$item->id?>"/>
                    <label style="width: 100%;" for="todo<?=$item->id?>"><?=$item->title?> <button data-url="<?php echo base_url("dashboard/todoDelete/$item->id")?>" class="btn btn-xs btn-link text-danger pull-right remove-btn"><i class="fa fa-trash"></i></button></label>
                </div>
            </li><!-- .todo-item -->
        <?php endforeach; ?>
    </ul><!-- .todo-list -->
    <?php else: ?>
    <div class="alert alert-success text-center" style="border: none;">
        <p><i class="fa fa-check-circle"></i> Tebrikler! Bütün görevler tamamlandı!</p>
    </div>
    <?php endif; ?>
</div>