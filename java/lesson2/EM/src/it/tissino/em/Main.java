package it.tissino.em;

public class Main {

    public static void main(String[] args) {

        EncryptionManager nem = new EncryptionManager();

        System.out.println(nem);

        CaesarEncryptionManager cem = new CaesarEncryptionManager();
        cem.setShift(4);

        // encrypting ZORRA with a 4-letter shift: expecting DSVVE
        System.out.println(cem.encrypt("ZORRA"));

        // decrypting DSVVE with a 4-letter shift: expecting ZORRA
        System.out.println(cem.decrypt("DSVVE"));

        System.out.println(cem);

        // outputs the number of EncryptionManagers actually created
        System.out.println(EncryptionManager.getCount());

    }
}

