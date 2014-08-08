<?php class Report_model extends MY_model {

    public function get_inout_list($start,$limit,$search){
        $group = $search["group"]?"WHERE `group`.`id` = ".$search["group"]:'';

        $sql = "
                        SELECT `group`.`id` AS `id`,
                        SUM(`group`.`name` AS `name`) AS name,
                        SUM(`product`.`value`) AS value,
                        SUM(`product`.`quantity`) AS quantity,
                        SUM(COALESCE(`invalue`,0)) AS `invalue`,
                        SUM(COALESCE(`outvalue`,0)) AS `outvalue`,
                        SUM(COALESCE(`inquantity`,0)) AS `inquantity`,
                        SUM(COALESCE(`outquantity`,0)) AS `outquantity`,
                        SUM((`product`.`value` * `product`.`quantity` + COALESCE(`outvalue`,0) + COALESCE(`OUTPUT`.`xvalue`,0) - COALESCE(`invalue`,0) + COALESCE(`INPUT`.`xvalue`,0))) AS `befvalue`,
                        SUM((`product`.`quantity` - COALESCE(`inquantity`,0) + COALESCE(`INPUT`.`xquantity`,0) + COALESCE(`outquantity`,0) + COALESCE(`OUTPUT`.`xquantity`,0))) AS `befquantity`
                        FROM (`product`)
                        LEFT JOIN
                            (SELECT `productinput`.`product`,
                            `xvalue`,
                            `xquantity`,
                            SUM(`quantity`) AS `inquantity`,
                            SUM(`value`*`quantity`)  AS `invalue`
                            FROM `productinput`
                            LEFT JOIN
                                (SELECT `product`,
                                SUM(`value`*`quantity`) AS `xvalue`,
                                SUM(`quantity`) AS `xquantity`
                                FROM `productinput`
                                WHERE `date` > '".$search['dateend']."'
                                GROUP BY `product`) AS `X` ON `X`.`product` = `productinput`.`product`
                            WHERE `date` BETWEEN '".$search['datebeg']."' AND '".$search['dateend']."'
                            GROUP BY `productinput`.`product`) AS `INPUT` ON `INPUT`.`product` = `product`.`id`
                        LEFT JOIN
                            (SELECT `productoutput`.`product`,
                            `xvalue`,
                            `xquantity`,
                            SUM(`quantity`) AS `outquantity`,
                            SUM(`value`*`quantity`) AS `outvalue`
                            FROM `productoutput`
                            LEFT JOIN
                                (SELECT `product`,
                                SUM(`value`*`quantity`) AS `xvalue`,
                                SUM(`quantity`) AS `xquantity`
                                FROM `productoutput`
                                WHERE `date` > '".$search['dateend']."'
                                GROUP BY `product`) AS `Y` ON `Y`.`product` = `productoutput`.`product`
                            WHERE `date` BETWEEN '".$search['datebeg']."' AND '".$search['dateend']."'
                            GROUP BY `product`) AS `OUTPUT` ON `OUTPUT`.`product` = `product`.`id`
                        JOIN `group` ON `group`.`id` = `product`.`group`
                        $group
                        GROUP BY `group`.`id`
                        ORDER BY `product`.`name`";

        if($search["group"]){
           // $sql .= "\nWHERE `group`.`id` = ".$search["group"];
        }

        if($limit>0){
            $sql .= "\nLIMIT $start, $limit";
        }


        $query =$this->db->query($sql);
        return $query->result();
    }

    public function get_inout_total($search){

         $group = $search["group"]?"WHERE `group`.`id` = ".$search["group"]:'';

         $sql = "SELECT COUNT(*) AS total
                FROM (`product`)
                LEFT JOIN
                    (SELECT `productinput`.`product`,
                    `xvalue`,
                    `xquantity`,
                    SUM(`quantity`) AS `inquantity`,
                    SUM(`value`*`quantity`)  AS `invalue`
                    FROM `productinput`
                    LEFT JOIN
                        (SELECT `product`,
                        SUM(`value`*`quantity`) AS `xvalue`,
                        SUM(`quantity`) AS `xquantity`
                        FROM `productinput`
                        WHERE `date` > '".$search['dateend']."'
                        GROUP BY `product`) AS `X` ON `X`.`product` = `productinput`.`product`
                    WHERE `date` BETWEEN '".$search['datebeg']."' AND '".$search['dateend']."'
                    GROUP BY `productinput`.`product`) AS `INPUT` ON `INPUT`.`product` = `product`.`id`
                LEFT JOIN
                    (SELECT `productoutput`.`product`,
                    `xvalue`,
                    `xquantity`,
                    SUM(`quantity`) AS `outquantity`,
                    SUM(`value`*`quantity`) AS `outvalue`
                    FROM `productoutput`
                    LEFT JOIN
                        (SELECT `product`,
                        SUM(`value`*`quantity`) AS `xvalue`,
                        SUM(`quantity`) AS `xquantity`
                        FROM `productoutput`
                        WHERE `date` > '".$search['dateend']."'
                        GROUP BY `product`) AS `Y` ON `Y`.`product` = `productoutput`.`product`
                    WHERE `date` BETWEEN '".$search['datebeg']."' AND '".$search['dateend']."'
                    GROUP BY `product`) AS `OUTPUT` ON `OUTPUT`.`product` = `product`.`id`
                JOIN `group` ON `group`.`id` = `product`.`group`
                $group
                ORDER BY `product`.`name`";

        if($search["group"]){
            //$sql .= "\nWHERE `group`.`id` = ".$search["group"];
        }

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return  $query->row(0)->total;
        }
        return false;
    }
}
