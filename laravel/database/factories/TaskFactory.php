<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    // タスク番号
    static $taskNumber = 0;

    // タスク名は固定で用意
    static $titles = [
        '会議の資料作成',
        'HTMLとCSSの基礎学習',
        'プレゼン資料の作成',
        'メールの返信',
        '顧客との打ち合わせ',
        'データベースの基礎知識とSQLの練習',
        '皿洗い',
        '報告書の提出',
        'ジムに行く',
        '家の掃除と片付け'
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'タスク' . static::$taskNumber + 1 . ' ' . static::$titles[static::$taskNumber++],
            'completed' => $this->faker->boolean,
        ];
    }
}
