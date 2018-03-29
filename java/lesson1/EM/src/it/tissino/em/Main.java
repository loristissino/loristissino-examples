package it.tissino.em;

public class Main {

    public static void main(String[] args) {

        EncryptionManager em = new EncryptionManager();

        em.setCypher(0);
        em.setShift(4);

        System.out.println(em.getShift());

        // encrypting ZORRA with a 4-letter shift: expecting DSVVE
        System.out.println(em.encrypt("ZORRA"));

        // decrypting DSVVE with a 4-letter shift: expecting ZORRA
        System.out.println(em.decrypt("DSVVE"));

    }
}

