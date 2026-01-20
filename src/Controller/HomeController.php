<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        $bots = [
            [
                'title' => 'YouTube & TikTok Downloader',
                'description' => 'Скачивайте видео и аудио с YouTube и TikTok в высоком качестве одним сообщением',
                'icon' => '🎬',
                'features' => ['Поддержка всех форматов', 'Быстрая загрузка', 'Выбор качества'],
            ],
            [
                'title' => 'Crypto Price Tracker',
                'description' => 'Получайте уведомления об изменениях цен на криптовалютных биржах в реальном времени',
                'icon' => '📈',
                'features' => ['Множество бирж', 'Настраиваемые алерты', 'История цен'],
            ],
            [
                'title' => 'Task Automation Bot',
                'description' => 'Автоматизируйте рутинные задачи: напоминания, планирование, уведомления',
                'icon' => '⚙️',
                'features' => ['Гибкое расписание', 'Интеграции с API', 'Многопользовательский режим'],
            ],
            [
                'title' => 'Web Scraper & Monitor',
                'description' => 'Мониторьте изменения на веб-сайтах и получайте уведомления о новых данных',
                'icon' => '🔍',
                'features' => ['Парсинг любых сайтов', 'Автоматические проверки', 'Экспорт данных'],
            ],
            [
                'title' => 'Price Drop Alert',
                'description' => 'Отслеживайте цены товаров в интернет-магазинах и получайте уведомления о скидках',
                'icon' => '💰',
                'features' => ['Множество магазинов', 'История цен', 'Умные фильтры'],
            ],
            [
                'title' => 'Subscription Manager',
                'description' => 'Управляйте подписками на сервисы, отслеживайте сроки и расходы',
                'icon' => '📱',
                'features' => ['Календарь подписок', 'Аналитика расходов', 'Напоминания'],
            ],
        ];

        $faqs = [
            [
                'question' => 'Как быстро можно получить готового бота?',
                'answer' => 'Стандартные боты готовы в течение 3-5 рабочих дней. Для кастомных решений сроки обсуждаются индивидуально.',
            ],
            [
                'question' => 'Можно ли кастомизировать бота под мои нужды?',
                'answer' => 'Конечно! Мы создаем ботов с учетом ваших требований и можем добавить любые функции.',
            ],
            [
                'question' => 'Нужно ли мне техническое обслуживание?',
                'answer' => 'Мы предоставляем техническую поддержку и обновления. Вы также можете выбрать план с полным обслуживанием.',
            ],
            [
                'question' => 'Как происходит оплата?',
                'answer' => 'Оплата производится после согласования технического задания. Возможна рассрочка для крупных проектов.',
            ],
            [
                'question' => 'Можно ли протестировать бота перед покупкой?',
                'answer' => 'Да, мы предоставляем демо-версию для тестирования основных функций.',
            ],
        ];

        return $this->render('home/index.html.twig', [
            'bots' => $bots,
            'faqs' => $faqs,
        ]);
    }

    #[Route('/contact', name: 'contact', methods: ['POST'])]
    public function contact(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        // TODO: отправка email или сохранение в БД
        return $this->json([
            'success' => true,
            'message' => 'Спасибо за обращение! Мы свяжемся с вами в ближайшее время.',
        ]);
    }
}
