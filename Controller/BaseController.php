<?php 
        class BaseController{
                protected function View($path,array $data = [])
                {
                        foreach($data as $key => $value)
                        {
                                $$key = $value;
                        }
                        return require($path);
                }
        }
?>