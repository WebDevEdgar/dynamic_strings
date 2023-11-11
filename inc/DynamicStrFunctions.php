<?php
if (!class_exists('DynamicStrFunctions')){
    final class DynamicStrFunctions{
        public static function getStringByLang(string $string, string $lang) : string{
            $strings = DynamicStrDB::getStringByLang($string, $lang);
            if (!empty($strings)){
                return self::beautyRow($strings[0]);
            }
            return self::notFound();
        }

        public static function removeString(string $original, string $lang) : bool{
            return DynamicStrDB::removeString($original, $lang);
        }

        public static function setString(string $originName, string $langSlug, string $translated, string $groupName) : bool{
            return DynamicStrDB::setString($originName, $langSlug, $translated, $groupName);
        }

        public static function getStringsByGroup($groupName, $lang, bool $associative = true) : array{
            $strings = DynamicStrDB::getStringsByGroup($groupName, $lang);
            if (!empty($strings)){
                $arr = [];
                foreach ($strings as $string){
                    if ($associative){
                        $arr[$string['originName']] = $string['translated'];
                    }else{
                        $arr[] = $string['translated'];
                    }
                }
                return $arr;
            }
            return array(self::notFound());
        }

        /*
         * Description: Method works, when does not find the rows
         */
        private static function notFound() : string{
            return 'Not Found';
        }

        /**
         * @param array $row
         * @return string
         */
        private static function beautyRow(array $row) : string{
            return $row['translates'] ?? self::notFound();
        }
    }
}