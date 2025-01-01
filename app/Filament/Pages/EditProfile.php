<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Forms;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class EditProfile extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $title = 'ویرایش پروفایل';
    protected static ?string $navigationLabel = 'ویرایش پروفایل';
    protected static string $view = 'filament.pages.edit-profile';
    protected static bool $shouldRegisterNavigation = false;

    public $name;
    public $last_name;
    public $email;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('نام')
                ->required(),
            TextInput::make('last_name')
                ->label('نام خانوادگی')
                ->required(),
            TextInput::make('mobile_number')
                ->label('شماره موبایل')
                ->required()
                ->rule('regex:/^09\d{9}$/')
                ->placeholder('09xxxxxxxxx'),

            Select::make('province')
                ->label('استان')
                ->required()
                ->options([
                    'البرز' => 'البرز',
                    'اردبیل' => 'اردبیل',
                    'اصفهان' => 'اصفهان',
                    'آذربایجان شرقی' => 'آذربایجان شرقی',
                    'آذربایجان غربی' => 'آذربایجان غربی',
                    'بوشهر' => 'بوشهر',
                    'چهارمحال و بختیاری' => 'چهارمحال و بختیاری',
                    'تهران' => 'تهران',
                    'خراسان جنوبی' => 'خراسان جنوبی',
                    'خراسان رضوی' => 'خراسان رضوی',
                    'خراسان شمالی' => 'خراسان شمالی',
                    'خوزستان' => 'خوزستان',
                    'زنجان' => 'زنجان',
                    'سمنان' => 'سمنان',
                    'سیستان و بلوچستان' => 'سیستان و بلوچستان',
                    'فارس' => 'فارس',
                    'قزوین' => 'قزوین',
                    'قم' => 'قم',
                    'کردستان' => 'کردستان',
                    'کرمان' => 'کرمان',
                    'کرمانشاه' => 'کرمانشاه',
                    'کهگیلویه و بویراحمد' => 'کهگیلویه و بویراحمد',
                    'گلستان' => 'گلستان',
                    'گیلان' => 'گیلان',
                    'لرستان' => 'لرستان',
                    'مازندران' => 'مازندران',
                    'مرکزی' => 'مرکزی',
                    'هرمزگان' => 'هرمزگان',
                    'همدان' => 'همدان',
                    'یزد' => 'یزد',
                ])
                ->placeholder('انتخاب کنید'),
            TextInput::make('email')
                ->disabled()
                ->label('ایمیل')
                ->email()
                ->required(),
        ];
    }

    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;

        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'last_name' => $user->last_name,
        ]);
    }

    public function save()
    {
        $data = $this->form->getState();

        $user = Auth::user();
        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        //$user->email = $data['email'];
        $user->save();

        Notification::make()
            ->title('عملیات موفق')
            ->body('اطلاعات پروفایل با موفقیت به‌روزرسانی شد!')
            ->success()
            ->send();
    }
}
