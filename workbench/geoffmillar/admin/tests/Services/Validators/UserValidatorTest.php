<?php namespace GeoffMillar\Admin\Test\Services\Validators;

use GeoffMillar\Admin\Tests\TestCase;
use GeoffMillar\Admin\Services\Validators\UserValidator;
use Mockery;

class UserValidatorTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

	public function testTransformUniquesSuccess()
	{
//		$this->assertTrue($this->transformUniques(2));
	}

	public function testTransformUniquesFailure()
	{
//		$this->assertFalse($this->transformUniques(3));
	}

	private function transformUniques($userId)
	{
		$userMock = $this->getUserMock($userId);
		$validator = new UserValidator();
		$validator->updateUniques($userMock->getId());
		$success = $validator->passesEdit(array(
			'username' => 'Geoff',
			'name' => 'Geoff Millar',
			'email' => 'geoff@pixperfect.co.uk',
		));

		return $success;
	}

	private function getUserMock($id)
	{
		$mock = Mockery::mock('Model');
		$mock->shouldReceive('getId')->once()->andReturn($id);

		return $mock;
	}
}
