<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
    require('holiday.php');

    $dt      = new DateTimeImmutable('first day of this month 00:00:00');
    $dt_prev = $dt->sub(new DateInterval('P1M'));
    $dt_next = $dt->add(new DateInterval('P1M'));


    $jd = cal_to_jd(CAL_GREGORIAN, date("m"),date("d"), date("Y"));
    $current = "". jdmonthname ($jd ,1)." ". $dt->format('Y'). "";

    $prev    = $dt_prev->format('?\y=Y&\a\mp;\m=n');
    $next    = $dt_next->format('?\y=Y&\a\mp;\m=n');

    $max    = (int)$dt->format('t');           // 合計日数
    $before = (int)$dt->format('w');           // 曜日オフセット(前)
    $after  = (7 - ($before + $max) % 7) % 7;  // 曜日オフセット(後)
    $today  = (int)(new DateTime)->format('d'); // 今日


    /* カレンダー生成ロジック */
    $rows = array_chunk(array_merge(
        array_fill(0, $before, ''),
        range(1, $max),
        array_fill(0, $after, '')
    ), 7);

?>
<hr/>
<div class="columns">
    <div class="column is-12-mobile is-10 is-offset-1">
        <table class="table is-bordered">
            <tr>
                <th colspan="10"><h2><?php echo $current?></h2></th>
            </tr>
            <tr>
                <th class="is-danger">Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th class="is-info">Sat</th>
            </tr>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <?php foreach ($row as $cell): ?>
                        <?php if ($cell === $today ): ?>
                            <td class="is-selected"><?php echo $cell?></td>
                        <?php else: ?>
                            <td><?php echo $cell?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
        </table>
    </div>
</div>
</body>
</html>