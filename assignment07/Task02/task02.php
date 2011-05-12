<?php
$clothAvailable = 160;
$labourAvailable = 150;
$shirtsNeeded=0;
$shortsNeeded=0;
$pantsNeeded =0 ;
$bestProfit = 0;
$machinecost=0;

for ($shirt = 0; $shirt <= 40; $shirt ++)
{
	$machinecost = 0;
		if ($shirt >= 1 )
		{
			$machinecost = 200;
			
		}
	for ($short = 0; $short <= 53; $short ++)
	{
			if ($short == 1)
			{
				$machinecost = $machinecost + 150;
			}	
		for ($pant = 0; $pant <= 25; $pant ++)
		{
				if ($pant == 1)
				{
					$machinecost = $machinecost + 100;
				}
			
				$profit = ($shirt * 6)+($short * 4)+($pant * 7);
				$labourUsed = ($shirt * 3)+($short * 2)+($pant * 6);
				$clothUsed = ($shirt * 4)+($short * 3)+($pant * 4);
				
				$totalprofit = ($profit - $machinecost);
				if (($bestProfit < ($totalprofit)) && ($labourUsed <= $labourAvailable) && ($clothUsed <= $clothAvailable))
				{
						$bestProfit = $totalprofit;
						$shirtsNeeded = $shirt;
						$shortsNeeded = $short;
						$pantsNeeded = $pant;
						
				}
		}	
	}
}
	
echo "You will need to make ".$shirtsNeeded." shirts and ".$shortsNeeded." shorts and ".$pantsNeeded." pants for the best profit $".$bestProfit."
" ;
