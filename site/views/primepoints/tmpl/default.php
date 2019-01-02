<h1>My Prime Points</h1>
<div>You have <?php echo $this->points; ?> Prime Points</div>
<table class="table">
<thead>
<tr><td>Time</td><td>Points</td><td>Comment</td></tr>
</thead>
<tbody>
 <?php

    foreach ($this->history as $line) {?>
    <tr><td><?php echo $line->datetime; ?></td><td><?php echo $line->points; ?></td><td><?php echo $line->description; ?></td></tr>

<? } ?>
</tbody>
</table>