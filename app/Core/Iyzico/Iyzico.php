<?php

namespace App\Core\Iyzico;

use Exception;
use Illuminate\Support\Carbon;
use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\Payment;
use Iyzipay\Model\PaymentCard;
use Iyzipay\Model\PaymentChannel;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Model\ThreedsInitialize;
use Iyzipay\Model\ThreedsPayment;
use Iyzipay\Options;
use Iyzipay\Request\CreatePaymentRequest;
use Iyzipay\Request\CreateThreedsPaymentRequest;

class Iyzico
{
    protected Options $options;
    protected CreatePaymentRequest $request;
    protected array $basketItems;

    public function __construct()
    {
        $this->setOptions();
        $this->setRequest();
    }

    /**
     * Iyziconun ayarlarını yapar
     * @return void
     */
    private function setOptions(): void
    {
        $this->options = new Options();
        $this->options->setApiKey(config('services.iyzico.api_key'));
        $this->options->setSecretKey(config('services.iyzico.secret_key'));
        $this->options->setBaseUrl(config('services.iyzico.base_url'));
    }

    /**
     * Ödeme isteğinin yapısını oluşturur
     * @return void
     */
    private function setRequest(): void
    {
        $this->request = new CreatePaymentRequest();
        $this->request->setPaymentChannel(PaymentChannel::WEB);
        $this->request->setPaymentGroup(PaymentGroup::PRODUCT);
    }

    /**
     * İmza oluşturur
     * @param array $params
     * @return string
     */
    protected function calculateSignature(array $params): string
    {
        $secretKey = config('services.iyzico.secret_key');
        $dataToSign = implode(':', $params);
        $mac = hash_hmac('sha256', $dataToSign, $secretKey, true);
        return bin2hex($mac);
    }


    /**
     * Sepete ürün ekler
     * @param string $id Ürün id'si başına otomatik olarak BI eklenir
     * @param string $name Ürün adı
     * @param string $price Ürün fiyatı
     * @param string|null $category1 Ürün kategorisi varsayılan olarak Beatify
     * @param string|null $category2 Ürün kategorisi varsayılan olarak Subscription
     * @param string $itemType Ürün tipi varsayılan olarak VIRTUAL
     * @return $this
     */
    public function addItem(
        string  $id,
        string  $name,
        string  $price,
        ?string $category1 = null,
        ?string $category2 = null,
        string  $itemType = BasketItemType::VIRTUAL,
    ): static
    {
        $basketItem = new BasketItem();
        $basketItem->setId('BI' . $id);
        $basketItem->setName($name);
        $basketItem->setCategory1($category1 ?? 'Beatify');
        $basketItem->setCategory2($category2 ?? 'Subscription');
        $basketItem->setItemType($itemType);
        $basketItem->setPrice($price);
        $this->basketItems[] = $basketItem;

        return $this;
    }

    /**
     * Fatura adresini ayarlar
     * @param string $contactName Fatura adresi kişi adı
     * @param string $city Fatura adresi şehir
     * @param string $country Fatura adresi ülke
     * @param string $address Fatura adresi
     * @param string $zipCode Fatura adresi posta kodu
     * @return $this
     */
    public function setBillingAddress(
        string $contactName,
        string $city,
        string $country,
        string $address,
        string $zipCode
    ): static
    {
        $billingAddress = new Address();
        $billingAddress->setContactName($contactName);
        $billingAddress->setCity($city);
        $billingAddress->setCountry($country);
        $billingAddress->setAddress($address);
        $billingAddress->setZipCode($zipCode);
        $this->request->setBillingAddress($billingAddress);

        return $this;
    }

    /**
     * Kargo adresini ayarlar (Sistemde gerekli olmasa dahi zorunlu)
     * @param string $contactName Kargo adresi kişi adı
     * @param string $city Kargo adresi şehir
     * @param string $country Kargo adresi ülke
     * @param string $address Kargo adresi
     * @param string $zipCode Kargo adresi posta kodu
     * @return $this
     */
    public function setShippingAddress(
        string $contactName,
        string $city,
        string $country,
        string $address,
        string $zipCode
    ): static
    {
        $shippingAddress = new Address();
        $shippingAddress->setContactName($contactName);
        $shippingAddress->setCity($city);
        $shippingAddress->setCountry($country);
        $shippingAddress->setAddress($address);
        $shippingAddress->setZipCode($zipCode);
        $this->request->setShippingAddress($shippingAddress);

        return $this;
    }

    /**
     * Alıcı bilgilerini ayarlar
     * @param string $id Alıcı id'si başına otomatik olarak U eklenir. Users tablosundaki idyi kullanabilirsiniz
     * @param string $name Alıcı adı
     * @param string $surname Alıcı soyadı
     * @param string $gsmNumber Alıcı GSM numarası
     * @param string $email Alıcı e-posta adresi
     * @param string $identityNumber Alıcı kimlik numarası
     * @param string $lastLoginDate Alıcı son giriş tarihi
     * @param string $registrationDate Alıcı kayıt tarihi
     * @param string $registrationAddress Alıcı kayıt adresi
     * @param string $ip Alıcı IP adresi
     * @param string $city Alıcı şehir
     * @param string $country Alıcı ülke
     * @param string $zipCode Alıcı posta kodu
     * @return $this
     */
    public function setBuyer(
        string $id,
        string $name,
        string $surname,
        string $gsmNumber,
        string $email,
        string $identityNumber,
        string $lastLoginDate,
        string $registrationDate,
        string $registrationAddress,
        string $ip,
        string $city,
        string $country,
        string $zipCode
    ): static
    {
        $buyer = new Buyer();
        $buyer->setId("U" . $id);
        $buyer->setName($name);
        $buyer->setSurname($surname);
        $buyer->setGsmNumber($gsmNumber);
        $buyer->setEmail($email);
        $buyer->setIdentityNumber($identityNumber);
        $buyer->setLastLoginDate(Carbon::parse($lastLoginDate)->format('Y-m-d H:i:s'));
        $buyer->setRegistrationDate(Carbon::parse($registrationDate)->format('Y-m-d H:i:s'));
        $buyer->setRegistrationAddress($registrationAddress);
        $buyer->setIp($ip);
        $buyer->setCity($city);
        $buyer->setCountry($country);
        $buyer->setZipCode($zipCode);
        $this->request->setBuyer($buyer);

        return $this;
    }

    /**
     * Ödeme kartını ayarlar
     * @param string $cardHolderName Kart sahibi adı
     * @param string $cardNumber Kart numarası
     * @param string $expireMonth Kart son kullanma ayı
     * @param string $expireYear Kart son kullanma yılı
     * @param string $cvc Kart güvenlik kodu
     * @param bool $registerCard Kartı kaydetsin mi?
     * @return $this
     */
    public function setPaymentCard(
        string $cardHolderName,
        string $cardNumber,
        string $expireMonth,
        string $expireYear,
        string $cvc,
        bool   $registerCard = true
    ): static
    {
        $paymentCard = new PaymentCard();
        $paymentCard->setCardHolderName($cardHolderName);
        $paymentCard->setCardNumber($cardNumber);
        $paymentCard->setExpireMonth($expireMonth);
        $paymentCard->setExpireYear($expireYear);
        $paymentCard->setCvc($cvc);
        $paymentCard->setRegisterCard($registerCard ? 1 : 0);
        $this->request->setPaymentCard($paymentCard);

        return $this;
    }

    /**
     * Kayıtlı kartı ayarlar
     * @param string $cardToken Kart token
     * @param string $cardUserKey Kart kullanıcı anahtarı
     * @return $this
     */
    public function setSavedCard(
        string $cardToken,
        string $cardUserKey
    ): static
    {
        $paymentCard = new PaymentCard();
        $paymentCard->setCardUserKey($cardUserKey);
        $paymentCard->setCardToken($cardToken);
        $this->request->setPaymentCard($paymentCard);

        return $this;
    }

    /**
     * Ödeme işlemini başlatır
     * @param string $locale Dil seçeneği (TR, EN)
     * @param string $conversationId Conversation id başına otomatik olarak beat- eklenir. Payment tablosundaki idyi kullanabilirsiniz
     * @param string $currency Para birimi (TRY,EUR,USD,GBP,IRR,NOK,RUB,CHF)
     * @param string|null $callbackUrl 3D Secure işlemi sonrası dönüş yapılacak url varsayılan olarak null
     * @param bool $threeDS 3D Secure işlemi yapacak mı? Varsayılan olarak true
     * @param int $installment Taksit sayısı varsayılan olarak 1
     * @param string|null $basketId Sepet idsi varsayılan olarak null
     * @return array
     * @throws Exception
     */
    public function pay(
        string  $locale,
        string  $conversationId,
        string  $currency,
        ?string $callbackUrl = null,
        bool    $threeDS = true,
        int     $installment = 1,
        ?string $basketId = null
    ): array
    {
        if (!$this->request->getPaymentCard()) throw new Exception('Payment card is required');
        if (!$this->request->getBuyer()) throw new Exception('Buyer is required');
        if (!$this->request->getBillingAddress()) throw new Exception('Billing address is required');
        if (!$this->request->getShippingAddress()) throw new Exception('Shipping address is required');
        if (empty($this->basketItems)) throw new Exception('Basket items are required');

        $this->request->setBasketItems($this->basketItems);
        $price = array_sum(array_map(fn($i) => $i->getPrice(), $this->basketItems));

        $this->request->setLocale($locale);
        $this->request->setConversationId('beat-' . $conversationId);
        $this->request->setPrice($price);
        $this->request->setPaidPrice($price);
        $this->request->setCurrency($currency);
        $this->request->setInstallment($installment);
        if ($basketId) $this->request->setBasketId($basketId);

        if ($threeDS) {
            if (!$callbackUrl) throw new Exception('Callback url is required');

            $this->request->setCallbackUrl($callbackUrl);

            $payment = ThreedsInitialize::create($this->request, $this->options);
            if ($payment->getStatus() !== 'success') throw new Exception($payment->getErrorMessage());

            $paymentId = $payment->getPaymentId();
            $conversationId = $payment->getConversationId();
            $signature = $payment->getSignature();

            $calculatedSignature = $this->calculateSignature([$paymentId, $conversationId]);

            if ($signature !== $calculatedSignature) throw new Exception('Invalid signature');

            return [
                'status' => 'success',
                'message' => __('3DS işlemi başlatıldı.'),
                'html' => $payment->getHtmlContent(),
            ];
        }

        $payment = Payment::create($this->request, $this->options);
        if ($payment->getStatus() !== 'success') throw new Exception($payment->getErrorMessage());

        return [
            'status' => 'success',
            'message' => __('Ödeme başarılı.'),
            'payment' => $payment,
        ];
    }

    /**
     * 3D Secure işlemi sonrası ödeme işlemini tamamlar
     * @param string $locale
     * @param string $conversationId
     * @param string $paymentId
     * @return ThreedsPayment
     * @throws Exception
     */
    public function finish3d(
        string $locale,
        string $conversationId,
        string $paymentId,
    ): ThreedsPayment
    {
        $request = new CreateThreedsPaymentRequest();
        $request->setLocale($locale);
        $request->setConversationId($conversationId);
        $request->setPaymentId($paymentId);

        $payment = ThreedsPayment::create($request, $this->options);

        if ($payment->getStatus() !== 'success'){
            throw new Exception($payment->getErrorMessage());
        }

        $paymentId = $payment->getPaymentId();
        $currency = $payment->getCurrency();
        $basketId = $payment->getBasketId();
        $conversationId = $payment->getConversationId();
        $paidPrice = $payment->getPaidPrice();
        $price = $payment->getPrice();
        $signature = $payment->getSignature();

        $calculatedSignature = $this->calculateSignature([$paymentId, $currency, $basketId, $conversationId, $paidPrice, $price]);

        if ($signature !== $calculatedSignature) throw new Exception('Invalid signature');

        return $payment;
    }
}
