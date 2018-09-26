convention
    test folder/file structure mirror source code structure
    test class filename end with `Test`
    test functions are public and name begin with `test`
    test functions name should be descriptive and only test one thing
    use the most proper assertion
    不要为外部库编写测试代码(除非你有特别的理由不信任它)
    单元测试和功能测试不要直接用开发数据库
    每个测试应该只测一个功能, 且不应该互相依赖
assertion
    $this->assert*
test exception/error(warning | notice)
    @expectedException
    @expectedExceptionCode
    @expectedExceptionMessage
    @expectedExceptionMessageRegExp
test output
    $this->expectOutputString();
    $this->expectOutputRegex();
mark test incomplete or optional
    $this->markTestIncomplete();
    $this->markTestSkipped();
setting up fixtures
    $this->setUp()
    $this->tearDown()
    self::setUpBeforeClass()
    self::tearDownAfterClass()
test file system
    use vfsStream(see on github)

==================== Reference ====================
assertion
    assertArrayHasKey()
    assertClassHasAttribute()
    assertArraySubset()
    assertClassHasStaticAttribute()
    assertContains()
    assertContainsOnly()
    assertContainsOnlyInstancesOf()
    assertCount()
    assertEmpty()
    assertEqualXMLStructure()
    assertEquals()
    assertFalse()
    assertFileEquals()
    assertFileExists()
    assertGreaterThan()
    assertGreaterThanOrEqual()
    assertInfinite()
    assertInstanceOf()
    assertInternalType()
    assertJsonFileEqualsJsonFile()
    assertJsonStringEqualsJsonFile()
    assertJsonStringEqualsJsonString()
    assertLessThan()
    assertLessThanOrEqual()
    assertNan()
    assertNull()
    assertObjectHasAttribute()
    assertRegExp()
    assertStringMatchesFormat()
    assertStringMatchesFormatFile()
    assertSame()
    assertStringEndsWith()
    assertStringEqualsFile()
    assertStringStartsWith()
    assertThat()
    assertTrue()
    assertXmlFileEqualsXmlFile()
    assertXmlStringEqualsXmlFile()
    assertXmlStringEqualsXmlString()
Annotation
    @author
    @after
    @afterClass
    @backupGlobals
    @backupStaticAttributes
    @before
    @beforeClass
    @codeCoverageIgnore*
    @covers
    @coversDefaultClass
    @coversNothing
    @dataProvider
    @depends
    @expectedException
    @expectedExceptionCode
    @expectedExceptionMessage
    @expectedExceptionMessageRegExp
    @group
    @large
    @medium
    @preserveGlobalState
    @requires
    @runTestsInSeparateProcesses
    @runInSeparateProcess
    @small
    @test
    @testdox
    @ticket
    @uses