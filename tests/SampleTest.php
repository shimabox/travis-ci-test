<?php
/**
 * メッセージ(json)を返すAPIと仮定
 *
 * あくまでもサンプルなので例外処理は入れていません
 */
class Sample
{
    /**
     * @var array
     */
    protected $messages = array(
        1 => "hoge",
        2 => "piyo"
    );
    /**
     * @param int $id
     */
    public function getMessage($id)
    {
        $message = array("message" => $this->messages[$id]);
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($message);
    }
}
/**
 * jsonを返すAPIのテストコード
 *
 * @group Sample
 */
class SampleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_output_a_message()
    {
        $expected = json_encode(array("message" => "hoge"));
        $sample = new Sample();
        ob_start();
        $sample->getMessage(1);
        $actual = ob_get_contents();
        ob_end_clean();
        $this->assertSame($expected, $actual);
    }
}
