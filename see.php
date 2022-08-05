<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <pre class='xdebug-var-dump' dir='ltr'>
<small>C:\laragon\www\ionicserver\manage-data.php:40:</small><small>string</small> <font color='#cc0000'>'key'</font> <i>(length=3)</i>
</pre>
    <pre class='xdebug-var-dump' dir='ltr'>
<small>C:\laragon\www\ionicserver\manage-data.php:40:</small><small>string</small> <font color='#cc0000'>'connexion'</font> <i>(length=9)</i>
</pre>
    <pre class='xdebug-var-dump' dir='ltr'>
<small>C:\laragon\www\ionicserver\manage-data.php:335:</small><small>string</small> <font color='#cc0000'>'CONNEXION USER detecté'</font> <i>(length=23)</i>
</pre><br />
    <font size='1'>
        <table class='xdebug-error xe-warning' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
            <tr>
                <th align='left' bgcolor='#f57900' colspan="5"><span
                        style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Warning:
                    PDOStatement::execute(): SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error
                    in your SQL syntax; check the manual that corresponds to your MySQL server version for the right
                    syntax to use near '@feef.gt' at line 1 in C:\laragon\www\ionicserver\manage-data.php on line
                    <i>339</i></th>
            </tr>
            <tr>
                <th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th>
            </tr>
            <tr>
                <th align='center' bgcolor='#eeeeec'>#</th>
                <th align='left' bgcolor='#eeeeec'>Time</th>
                <th align='left' bgcolor='#eeeeec'>Memory</th>
                <th align='left' bgcolor='#eeeeec'>Function</th>
                <th align='left' bgcolor='#eeeeec'>Location</th>
            </tr>
            <tr>
                <td bgcolor='#eeeeec' align='center'>1</td>
                <td bgcolor='#eeeeec' align='center'>0.0006</td>
                <td bgcolor='#eeeeec' align='right'>458072</td>
                <td bgcolor='#eeeeec'>{main}( )</td>
                <td title='C:\laragon\www\ionicserver\manage-data.php' bgcolor='#eeeeec'>...\manage-data.php<b>:</b>0
                </td>
            </tr>
            <tr>
                <td bgcolor='#eeeeec' align='center'>2</td>
                <td bgcolor='#eeeeec' align='center'>0.0020</td>
                <td bgcolor='#eeeeec' align='right'>511856</td>
                <td bgcolor='#eeeeec'><a href='http://www.php.net/PDOStatement.execute' target='_new'>execute</a>( )
                </td>
                <td title='C:\laragon\www\ionicserver\manage-data.php' bgcolor='#eeeeec'>...\manage-data.php<b>:</b>339
                </td>
            </tr>
        </table>
    </font>
    <br />
    <font size='1'>
        <table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
            <tr>
                <th align='left' bgcolor='#f57900' colspan="5"><span
                        style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice:
                    Trying to access array offset on value of type bool in C:\laragon\www\ionicserver\manage-data.php on
                    line <i>341</i></th>
            </tr>
            <tr>
                <th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th>
            </tr>
            <tr>
                <th align='center' bgcolor='#eeeeec'>#</th>
                <th align='left' bgcolor='#eeeeec'>Time</th>
                <th align='left' bgcolor='#eeeeec'>Memory</th>
                <th align='left' bgcolor='#eeeeec'>Function</th>
                <th align='left' bgcolor='#eeeeec'>Location</th>
            </tr>
            <tr>
                <td bgcolor='#eeeeec' align='center'>1</td>
                <td bgcolor='#eeeeec' align='center'>0.0006</td>
                <td bgcolor='#eeeeec' align='right'>458072</td>
                <td bgcolor='#eeeeec'>{main}( )</td>
                <td title='C:\laragon\www\ionicserver\manage-data.php' bgcolor='#eeeeec'>...\manage-data.php<b>:</b>0
                </td>
            </tr>
        </table>
    </font>
    false
</body>

</html>