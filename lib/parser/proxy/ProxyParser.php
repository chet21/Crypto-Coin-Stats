<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.03.2018
 * Time: 10:14
 */

namespace Lib\Parser;


class ProxyParser extends BaseParser
{
    static public function getIp()
    {
        $html = self::curl('http://spys.one/proxys/UA/');
        $code = \phpQuery::newDocument($html);

//        $table = $code->find('.spy14')->htmlOuter();
//        $table = $code->find('body:eq(0)')->htmlOuter();

//        $tt = [];
//        preg_match_all('/([0-9]{1,3}[\.]){3}[0-9]{1,3}/', pq($table), $tt);


        $arr = [
            '/Three9OneFour[\^]SixFiveThree/',
            '/EightZeroNineSeven[\^]Two2Eight/',
            '/ZeroOneThreeFour[\^]SixEightFive/',
            '/FiveSevenSixOne[\^]OneFourZero/',
            '/Zero3ThreeThree[\^]Seven7Nine/',
            '/Three7TwoFive[\^]EightThreeOne/',
            '/Eight3FourSix[\^]NineZeroSeven/',
            '/SevenSevenSevenSeven[\^]One1Seven/',
            '/EightSevenNineFive[\^]Nine7Six/',
            '/SevenNineSevenTwo[\^]FourEightNine/',
            '/Three3SixSeven[\^]SixFiveFour/',
            '/Seven2NineEight[\^]One4Eight/',
            '/FourTwoOneThree[\^]OneEightTwo/',
            '/OneOneThreeFour[\^]Zero2Three/',

            '/Eight1SixFour[\^]Zero7Six/',
            '/Four4SevenOne[\^]Six7Five/',
            '/Five8NineEight[\^]Zero1One/',
            '/TwoNineTwoFive[\^]Eight1Seven/',
            '/Two0EightSix[\^]ZeroFiveNine/',
            '/Eight1SixFour[\^]Zero7Six/',
            '/ZeroTwoOneTwo[\^]Three9Zero/',
            '/One3ThreeSeven[\^]Seven1Three/'
        ];

        $key = [
            0, 1, 2, 3, 3, 5, 8, 8, 9, 5, 3, 2, 8, 1, 8, 0, 5, 3, 2, 8, 1, 4
        ];

        $x = preg_replace('/document.write/', '', $code);

        $x = preg_replace('/"<font class=spy2>/', '', $x);

        $x = preg_replace('/[\)+(<>:"]/', '', $x);

        $x = preg_replace('/\/font/', ':', $x);

        $x = preg_replace('/\\\\/', '', $x);

        $x = preg_replace($arr, $key, $x);

        preg_match_all('/([0-9]{1,3}[\.]){3}[0-9]{1,3}[\:][0-9]{2,5}/', $x, $tt);

        unset($tt[1]);

        return $code;
    }
}