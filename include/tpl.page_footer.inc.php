<?php require_once( dirname(__FILE__) . "/common.inc.php" ); ?>
<?php
	$start_year = '2009';
	$this_year = date('Y');
	if ( $this_year == $start_year )
		$_year_ = $start_year;
	else
		$_year_ = $start_year . '-' . $this_year;
?>
          </td>
          <td width="10"><img src="<?php echo $_bp_; ?>pic/space.gif" width="10" height="5"></td>
        </tr>
      </table></td>
    </tr>
    <tr align="center" bgcolor="#FFFFFF">
      <td colspan="2"><img src="<?php echo $_bp_; ?>pic/space.gif" width="10" height="10"></td>
    </tr>
    <tr align="center" bgcolor="#FFFFFF">
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr align="center" bgcolor="#D4D0C8">
      <td colspan="2"><span class="copyright">Copyright ©<?php echo $_year_; ?> International Dental Products Inc. All Rights Reserved. </span></td>
    </tr>
  </table>
</div>
